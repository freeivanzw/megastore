<?php

namespace App\Controllers\Admin;

class MenuController extends AdminController
{

    public function getSiteMenu()
    {
        $menu_items_model = new \App\Models\MenuItemsModel();

        dd($menu_items_model->getTopMenu());

    }

}
