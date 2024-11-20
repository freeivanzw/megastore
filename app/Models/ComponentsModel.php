<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentsModel extends Model
{
    protected $table      = 'components';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'menu_item_id', 'type', 'number_order'];

    /**
     * Get information about menu
     * @param $menu_id
     */
    public function getByMenuId(int $menu_id)
    {
        $components =  $this->select('id, title, type, number_order')
                            ->where('menu_item_id', $menu_id)
                            ->findAll();

        return $components;
    }

    /**
     * Get details information about menu
     * @param $menu_id
     */
    public function getAllByMenuId(int $menu_id)
    {
        $components =  $this->select('id, title, type, number_order')
                            ->where('menu_item_id', $menu_id)
                            ->findAll();

        foreach($components as $key => $value) {
            $table = $this->db->table($value['type'] . '_component');

            $results = $table->where('component_id', $value['id'])->get()->getResultArray();
            
            unset($results[0]['id']);

            $components[$key]['data'] = $results[0];
        }

        return $components;
    }
}