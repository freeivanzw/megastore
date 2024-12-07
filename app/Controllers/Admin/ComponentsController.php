<?php

namespace App\Controllers\Admin;

use App\Models\ComponentsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ComponentsController extends AdminController
{   
    private ComponentsModel $model;
    private $components = ['article'];

    public function __construct()
    {
        $this->model = new ComponentsModel();
    }

    public function index(int $component_id)
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

    public function getComponentsList(): array
    {
        return $this->components;
    }

    public function create()
    {
        $component_name = $this->request->getPost('component');
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
            'number_order' => null,
            'type'         => $component_name,
        ]);

        $component_id = $this->model->getInsertID();

        $component_model = new $component_class();
        $component_model->add($component_id);
        
        return redirect()->back();
    }

    public function edit()
    {
        $component_id = $this->request->getPost('component_id');
        $component_type = $this->request->getPost('component_type');
        $component_title = $this->request->getPost('title');
        $data = $this->request->getPost('data');

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
        $component_model->edit($component_id, $data);

        return redirect()->to('admin/component/' . $component_id);
    }

    public function remove()
    {
        $component_type = $this->request->getGet('type');
        $component_id = $this->request->getGet('id');

        $component_class = "\\App\\Controllers\\Admin\\" . ucfirst($component_type) . 'ComponentController';

        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_type}ComponentModel");
        }
        
        $component_model = new $component_class();
        $component_model->remove($component_id);

        $this->model->delete($component_id);
        
        return redirect()->back();
    }
}
