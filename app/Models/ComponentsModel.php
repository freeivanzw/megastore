<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentsModel extends Model
{
    protected $table      = 'components';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'menu_item_id', 'type', 'number_order'];

    public function getByMenuId(int $menuId)
    {
        $components =  $this->select('id, title, type, number_order')
                            ->where('menu_item_id', $menuId)
                            ->findAll();

        foreach($components as $key => $value) {
            $table = $this->db->table($value['type'] . '_component');

            $results = $table->where('component_id', $value['id'])->get()->getResultArray();
            
            $components[$key]['data'] = $results[0];
        }

        return $components;
    }
}