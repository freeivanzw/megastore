<?php

namespace App\Controllers\Front;

use CodeIgniter\Exceptions\PageNotFoundException;

class PagesController extends FrontController
{
    public function renderPage()
    {
        
        $siteLinks = new \App\Models\SiteLinksModel();
    
        $linkInfo = $siteLinks->getlinkInfo($this->request->getPath());
    
        if (!$linkInfo) {
            throw new PageNotFoundException('url not found');
        }
    
        if ($linkInfo['type'] === 'redirect') {
            return redirect()->to($linkInfo['url']);
        }
    
        if ($linkInfo['type'] === 'menu') {
            $componentsModel = new \App\Models\ComponentsModel();
            $components = $componentsModel->getByMenuId($linkInfo['menu_item_id']);
            
            dd($components);
        }
    }
}
