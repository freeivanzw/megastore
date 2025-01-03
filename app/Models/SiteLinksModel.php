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
        $url_segments = explode('/', $url);

        if ($type === 'admin') {
            $admin_url = $url_segments[1] ?? 'main-page';

            return $this->where('url', $admin_url)->first();
        }

        $frontUrl = $url_segments[0] !== '' ? $url_segments[0] : 'main-page';
        
        return $this->where('url', $frontUrl)->first();
    }
}