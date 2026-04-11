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
    // Page d'accueil publique et routes catégories
    $routes->get('/', 'HomeController::index');
    $routes->get('categorie/(:num)', 'HomeController::categorie/$1');
});

service('auth')->routes($routes);
