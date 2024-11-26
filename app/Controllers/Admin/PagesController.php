<?php

namespace App\Controllers\Admin;

use CodeIgniter\Exceptions\PageNotFoundException;

class PagesController extends AdminController
{
    public function index()
    {
        
        return $this->view->render();
    }

    public function renderPage()
    {
        $siteLinks = new \App\Models\SiteLinksModel();
    
        $linkInfo = $siteLinks->getlinkInfo($this->request->getPath(), 'admin');
    
        if (!$linkInfo) {
            throw new PageNotFoundException('url not found');
        }
    
        if ($linkInfo['type'] === 'redirect') {
            return redirect()->to($linkInfo['url']);
        }
    
        if ($linkInfo['type'] === 'menu') {
            $this->view->setLayout('Admin/Default');

            $componentsModel = new \App\Models\ComponentsModel();
            $components = $componentsModel->getByMenuId($linkInfo['menu_item_id']);

            $menu_model = new \App\Models\MenuItemsModel();
            $menu_data = $menu_model->find($linkInfo['menu_item_id']);

            $this->view->addComponent('Admin/Components/MenuDetails', $menu_data);

            foreach ($components as $component) {
                $controllerClass = "\\App\\Controllers\\Admin\\" . $component['type'] . 'Controller';

                if (class_exists($controllerClass)) {
                    $controller_component = new $controllerClass();

                    $this->view->addComponent($controller_component->preview($component), $component);
                }
            }
            
            return $this->view->render();
        }
    }
}