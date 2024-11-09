<?php

use CodeIgniter\Config\Factories;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Admin\MenuController::getSiteMenu');

$routes->group('admin', static function ($routes) {
    $routes->group('/', ['filter' => 'adminAuth'], static function ($routes) {

        $routes->group('auth', static function ($routes) {
            $routes->get('logout', 'Admin\AuthController::logout');
            $routes->post('register', 'Admin\AuthController::register');        
        });
    });

    
    $routes->group('auth', static function ($routes) {
        $routes->get('login', 'Admin\AuthController::login');
        $routes->post('login', 'Admin\AuthController::enter');
    });
});

$routes->get('(:any)', 'Front\PagesController::renderPage');
