<?php

namespace App\Controllers\Admin;

class MenuController extends AdminController
{

    public function index()
    {
        $menu_items_model = new \App\Models\MenuItemsModel();

        return $this->view
            ->addComponent('Admin/Components/SiteMenu')
            ->render();
    }

}
