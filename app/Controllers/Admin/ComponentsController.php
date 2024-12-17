<?php

namespace App\Controllers\Admin;

use App\Models\ComponentsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ComponentsController extends AdminController
{   
    private ComponentsModel $model;
    private $components = ['article', 'banner'];

    public function __construct()
    {
        $this->model = new ComponentsModel();
    }

    /**
     * Get comopnent details admin page
     * @param int $component_id
     * @return string
     */
    public function index(int $component_id): string
    {
        $component = $this->model->find($component_id);

        $component_class = "\\App\\Controllers\\Admin\\" . ucfirst($component['type']) . 'ComponentController';
        $component_model = new $component_class();

        $component_data = $component_model->get($component_id);
        
        $view_data = [
            ...$component_data,
            'id'              => $component['id'],
            'component_type'  => $component['type'],
            'component_title' => $component['title'],
        ];

        $view_component_path = "Admin/Components/" . ucfirst($component['type']) . 'Details';

        return $this->view
                    ->addComponent($view_component_path, $view_data)
                    ->render();
    }

    /**
     * Method use for get all components names
     * @return array
     */
    public function getComponentsList(): array
    {
        return $this->components;
    }

    /**
     * Create new component
     */
    public function create()
    {
        $component_name = $this->request->getPost('component');
        $component_idx  = $this->request->getPost('component_idx');
        $menu_id        = $this->request->getPost('menu_id');

        if ($menu_id === '' || $component_name === '') {
            throw new PageNotFoundException("data not correct");
        }

        $component_class = "\\App\\Controllers\\Admin\\" . ucfirst($component_name) . 'ComponentController';

        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_class}");
        }

        $this->model->save([
            'title'        => '',
            'menu_item_id' => $menu_id,
            'type'         => $component_name,
            'number_order' => $component_idx,
        ]);

        $component_id = $this->model->getInsertID();

        $component_model = new $component_class();
        $component_model->add($component_id);
        
        return redirect()->back();
    }

    /**
     * Edit component
     */
    public function edit()
    {
        $component_id = $this->request->getPost('component_id');
        $component_type = $this->request->getPost('component_type');
        $component_title = $this->request->getPost('title');

        if (!isset($component_id) || !isset($component_type)) {
            throw new PageNotFoundException("");
        }

        $component_class = "\\App\\Controllers\\Admin\\" . ucfirst($component_type) . 'ComponentController';
         
        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_class}ComponentModel");
        }

        $component = $this->model->find($component_id);
        $component['title'] = $component_title;
        $this->model->update($component_id, $component);

        $component_model = new $component_class();
        $component_model->edit($component_id, $this->request);

        return redirect()->to('admin/component/' . $component_id);
    }

    /**
     * Method change position components in list
     */
    public function changeOrder()
    {
        $component_id = (int) $this->request->getGet('id');
        $new_order = (int) $this->request->getGet('order');

        $current_component = $this->model->find($component_id);
        
        $second_component = $this->model->where('menu_item_id', $current_component['menu_item_id'])
                                        ->where('number_order', $new_order)
                                        ->find()[0];
        
        $second_component['number_order'] = $current_component['number_order']; 
        $current_component['number_order'] = $new_order;

        $this->model->save($current_component);
        $this->model->save($second_component);

        return redirect()->back();
    }

    /**
     * Remove component
     */
    public function remove($component_type, int $component_id)
    {
        $component_class = "\\App\\Controllers\\Admin\\" . ucfirst($component_type) . 'ComponentController';

        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_type}ComponentController");
        }
        
        $component_controller = new $component_class();
        $component_controller->remove($component_id);
        $this->model->delete($component_id);
        
        return redirect()->back();
    }
}
