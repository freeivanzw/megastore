<?php

namespace App\Controllers\Admin;

class PagesController extends AdminController
{
    public function index()
    {
        
        return $this->view->setLayout('Admin/Default')->render();
    }    
}