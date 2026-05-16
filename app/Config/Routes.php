<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// @var RouteCollection $routes

// Pages publiques (accessibles sans être connecté)
$routes->get('/', 'HomeController::index');
$routes->get('categorie/(:num)', 'HomeController::categorie/$1');  // <-- DÉPLACÉ ICI

// Routes protégées par l'authentification Shield
$routes->group('', ['filter' => 'session'], static function ($routes): void {
    $routes->get('item/form', 'ItemController::form');
    $routes->get('item/form/(:num)', 'ItemController::form/$1');
    $routes->post('item/save', 'ItemController::save');
    $routes->get('item/delete/(:num)', 'ItemController::delete/$1');
    $routes->post('item/increment-episode/(:num)', 'ItemController::incrementEpisode/$1');
    $routes->post('/items/update-order', 'ItemController::updateOrder');

    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserController::delete/$1');
});

// Routes pour l'administration des utilisateurs
$routes->group('admin/users', ['namespace' => 'App\Controllers\Admin'], static function ($routes): void {
    $routes->get('/', 'UserController::index');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1'); // POST pour la soumission du formulaire
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('unban/(:num)', 'UserController::unban/$1');
});

service('auth')->routes($routes);