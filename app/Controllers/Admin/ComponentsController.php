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
        $componentModel = new $component_class();
        
        $view_component_path = "Admin/Components/" . ucfirst($component['type']) . 'Details';
        $component_data = $componentModel->where('component_id', $component_id)->find()[0];

        return $this->view
                    ->addComponent($view_component_path, $component_data)
                    ->render();
    }

    public function create()
    {

        $component_name = 'article';
        $menu_id = 142;

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
        $component_model->addComponent($component_id);
        
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
