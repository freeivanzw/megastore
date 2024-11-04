<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuItemsModel extends Model
{
    protected $table      = 'menu_items';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'parent_id'];
}