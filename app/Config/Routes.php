<?php

use CodeIgniter\Config\Factories;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Front\Home::index');

$routes->group('admin', static function ($routes) {
    $routes->group('auth', static function ($routes) {
        $routes->get('login', 'Admin\AuthController::login');
        $routes->post('login', 'Admin\AuthController::enter');
    });
    
    $routes->group('/', ['filter' => 'adminAuth'], static function ($routes) {
        $routes->get('/', 'Admin\PagesController::index');

        $routes->group('menu', static function ($routes) {
            $routes->get('/', 'Admin\MenuController::index');
            $routes->post('(:num)', 'Admin\MenuController::createSubmenu/$1');
            $routes->patch('(:num)', 'Admin\MenuController::editMenu/$1');
            $routes->delete('(:num)', 'Admin\MenuController::removeMenu/$1');
        });

        $routes->group('component', static function ($routes) {
            $routes->post('/', 'Admin\ComponentsController::create');
        });

        $routes->group('auth', static function ($routes) {
            $routes->get('logout', 'Admin\AuthController::logout');
            $routes->post('register', 'Admin\AuthController::register');        
        });

        $routes->get('(:any)', 'Admin\PagesController::renderPage');
    });

    
   
});

$routes->get('(:any)', 'Front\PagesController::renderPage');
