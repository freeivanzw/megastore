<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteLinksModel extends Model
{
    protected $table      = 'site_links';
    protected $primaryKey = 'id';

    protected $allowedFields = ['url', 'type', 'menu_item_id', 'product_id'];

    /**
     * Get information from url
     * @param string $url
     * @param string $type
     * @return array
     */
    public function getlinkInfo(string $url, $type = 'front'): array
    {
        $urlSegments = explode('/', $url);

        if ($type === 'admin') {
            return $this->where('url', $urlSegments[1])->first();
        }
        
        return $this->where('url', $urlSegments[0])->first();
    }
}