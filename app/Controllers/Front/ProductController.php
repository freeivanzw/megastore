<?php

namespace App\Controllers\Front;

use App\Models\ProductModel;

class ProductController extends FrontController
{
    private ProductModel $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function index(int $id): string
    {
        $data = $this->model->find($id);


        return $this->view->addComponent('Front/Components/ProductDetalis', $data)->render();
    }
}