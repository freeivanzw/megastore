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
            $this->view->setLayout('Front/Default');

            $menu_model = new \App\Models\MenuItemsModel();

            $this->view->addGlobalData('top_menu', $menu_model->getTopMenu());

            $componentsModel = new \App\Models\ComponentsModel();
            $components = $componentsModel->getByMenuId($linkInfo['menu_item_id']);

            foreach ($components as $component) {
                $controllerClass = "\\App\\Controllers\\Front\\" . $component['type'] . 'Controller';

                if (class_exists($controllerClass)) {
                    $controller_component = new $controllerClass();
                    $data = $controller_component->publicData($component['id']);

                    $this->view->addComponent('Front/Components/' . $component['type'], $data);
                }
            }
            
            return $this->view->render();
        }
    }
}
