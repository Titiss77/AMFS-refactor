<?php declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Page d'accueil publique
$routes->get('/', 'HomeController::index');

// Routes protégées par l'authentification Shield
$routes->group('', ['filter' => 'session'], static function ($routes) {
    $routes->get('item/form', 'ItemController::form');
    $routes->get('item/form/(:num)', 'ItemController::form/$1');
    $routes->post('item/save', 'ItemController::save');
    $routes->get('item/delete/(:num)', 'ItemController::delete/$1');
});

service('auth')->routes($routes);
