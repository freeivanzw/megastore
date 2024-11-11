<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\Exceptions\BadRequestException;
use \App\Models\MenuItemsModel;

class MenuController extends AdminController
{
    private MenuItemsModel $model;

    public function __construct()
    {
        $this->model = new MenuItemsModel();
    }

    public function index()
    {
        $data = [
            'top_menu' => $this->model->getTopMenu(),
        ];

        return $this->view
            ->addComponent('Admin/Components/SiteMenu', $data)
            ->render();
    }

    public function removeMenu()
    {
        $menu_id = $this->request->getGet('menu_id');

        if (!isset($menu_id)) {
            throw new BadRequestException('menu_id must been integer');
        }

        if (!$this->model->delete($menu_id)) {
            throw new BadRequestException('this menu doesnt exits');
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => "menu_id: {$menu_id} removed",
        ]);
    }

}
