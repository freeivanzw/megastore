<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerComponentModel extends Model
{
    protected $table      = 'banner_component';
    protected $primaryKey = 'id';

    protected $allowedFields = ['subtitle', 'image', 'component_id'];   
}
