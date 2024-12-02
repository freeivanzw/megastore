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

        $component_class = "\\App\\Models\\" . ucfirst($component['type']) . 'ComponentModel';
        $component_model = new $component_class();
        
        $view_component_path = "Admin/Components/" . ucfirst($component['type']) . 'Details';
        $component_data = $component_model->where('component_id', $component_id)->find()[0];        

        $view_data = [
            ...$component_data,
            'id' => $component['id'],
            'component_type' => $component['type'],
            'component_title' => $component['title'],
        ];

        return $this->view
                    ->addComponent($view_component_path, $view_data)
                    ->render();
    }

    public function create()
    {
        $component_name = 'article';
        $menu_id = $this->request->getPost('menu_id');

        if (!isset($menu_id)) {
            throw new PageNotFoundException("need menu id");
        }

        $component_class = "\\App\\Models\\" . ucfirst($component_name) . 'ComponentModel';
        
        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_name}ComponentModel");
        }

        $this->model->save([
            'title' => '',
            'menu_item_id' => $menu_id,
            'number_order' => null,
            'type' => $component_name,
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

        $component_class = "\\App\\Models\\" . ucfirst($component_type) . 'ComponentModel';
         
        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_class}ComponentModel");
        }

        $component = $this->model->find($component_id);
        $component['title'] = $component_title;
        $this->model->update($component_id, $component);

        $component_model = new $component_class();
        $component_model->edit($component_id, $data);

        return redirect()->back();
    }

    public function remove()
    {
        $component_type = $this->request->getGet('type');
        $component_id = $this->request->getGet('id');

        $component_class = "\\App\\Models\\" . ucfirst($component_type) . 'ComponentModel';
        
        if (!class_exists($component_class)) {
            throw new PageNotFoundException("not found this class: {$component_type}ComponentModel");
        }

        $component_model = new $component_class();
        $component_model->where('component_id', $component_id)->delete();
        $this->model->delete($component_id);
        
        return redirect()->back();
    }
}
