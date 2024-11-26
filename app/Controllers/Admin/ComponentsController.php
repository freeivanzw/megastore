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
            'type' => ucfirst($component_name),
        ]);

        $component_id = $this->model->getInsertID();
        
        $component_model = new $component_class();
        $component_model->addComponent($component_id);
        
        return redirect()->back();
    }

}