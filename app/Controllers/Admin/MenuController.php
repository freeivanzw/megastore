<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\Exceptions\BadRequestException;
use \App\Models\MenuItemsModel;
use App\Models\SiteLinksModel;

class MenuController extends AdminController
{
    private MenuItemsModel $model;
    private SiteLinksModel $links;

    public function __construct()
    {
        $this->model = new MenuItemsModel();
        $this->links = new SiteLinksModel();
    }

    public function index()
    {
        $menu_items = $this->model->getTopMenu();

        $data = [
            'top_menu' => view('Admin/Components/TopMenu', ['menu_items' => $menu_items]),
        ];

        return $this->view
            ->addComponent('Admin/Components/SiteMenu', $data)
            ->render();
    }

    public function createSubmenu(int $parent_id) 
    {
        $menu_item = $this->model->find($parent_id);

        if (!isset($menu_item)) {
            throw new BadRequestException('this menu doesnt exits');
        }

        $data = [
            'title'     => '',
            'parent_id' => $parent_id,
        ];

        $this->model->save($data);
        
        $inserted_id = $this->model->insertID();
        $created_menu = $this->model->find($inserted_id);

        $this->links->save([
            'url'          => $inserted_id,
            'type'         => 'menu',
            'menu_item_id' => $inserted_id,
        ]);

        return response()->setJSON([
            'success'   => true,
            'menu_item' => $created_menu,
            'message'   => 'item menu has been created',
        ]);
    }

    public function removeMenu(int $menu_id)
    {
        if (!isset($menu_id)) {
            throw new BadRequestException('menu_id must been integer');
        }

        if (!$this->model->delete($menu_id) ) {
            throw new BadRequestException('this menu doesnt exits');
        }

        $this->links->where('menu_item_id', $menu_id)->delete();

        return $this->response->setJSON([
            'success' => true,
            'message' => "menu_id: {$menu_id} removed",
        ]);
    }

    public function editMenu(int $menu_id)
    {
        $menu_item = $this->model->find($menu_id);
        $new_title = $this->request->getVar('title');

        if (!isset($menu_item)) {
            throw new BadRequestException('this menu doesnt exits');
        }

        $menu_item['title'] = $new_title;

        $this->model->save($menu_item);

        $link = $this->links->where('menu_item_id', $menu_id)->find()[0];
        $link['url'] = generateSlug($new_title);
        $this->links->save($link);

        
        return response()->setJSON([
            'success' => true,
            'message' => 'title updated',
        ]);
    }

}
