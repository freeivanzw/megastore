<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteLinksModel extends Model
{
    protected $table      = 'site_links';
    protected $primaryKey = 'id';

    protected $allowedFields = ['url', 'type', 'menu_item_id', 'product_id'];

    public function getlinkInfo($url)
    {
        $urlSegments = explode('/', $url);
        
        return $this->where('url', $urlSegments[0])->first();
    }
}