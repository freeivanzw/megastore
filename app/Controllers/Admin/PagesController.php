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
            $menu_model = new \App\Models\MenuItemsModel();
            $components_controller = new \App\Controllers\Admin\ComponentsController();

            $menu_details_data = [
                'menu_data'       => $menu_model->find($linkInfo['menu_item_id']),
                'components_list' => $components_controller->getComponentsList(),
            ];

            $this->view->setLayout('Admin/Default')
                       ->addComponent('Admin/Components/MenuDetails', $menu_details_data);

            $componentsModel = new \App\Models\ComponentsModel();
            $components = $componentsModel->getByMenuId($linkInfo['menu_item_id']);

            foreach ($components as $component) {
                $controllerClass = "\\App\\Controllers\\Admin\\" . $component['type'] . 'ComponentController';

                if (class_exists($controllerClass)) {
                    $controller_component = new $controllerClass();

                    $this->view->addComponent('Admin/Components/ComponentPreview', $component);
                }
            }
            
            return $this->view->render();
        }
    }
}