<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuItemsModel extends Model
{
    protected $table      = 'menu_items';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'parent_id'];

    /**
     * Method for geneerate all top menu
     */
    public function getTopMenu() : array
    {
        $menu_main_item = $this->where('id', 1)->find()[0];
        $menu_items = $this->findAll();
        
        $top_menu[] = [
            ...$menu_main_item,
            'children' => $this->recurionSortingMenu($menu_items, 1)
        ];

        return $top_menu;
    }

    /**
     * This mentod use for sording menu
     * @param array $menu_items
     * @param int $parent_id
     * @return array
     */
    private function recurionSortingMenu(array $menu_items, int $parent_id) : array
    {
        $childen_items = array_filter($menu_items, function ($item) use ($parent_id) {     
            return $item['parent_id'] == $parent_id;
        });

        if (count($childen_items) == 0) {
            return [];
        }

        $tree = [];

        foreach ($childen_items as $item) {
            $tree[] = [
                ...$item,
                'children' => $this->recurionSortingMenu($menu_items, $item['id'])
            ];
        }

        return $tree;
    }
}