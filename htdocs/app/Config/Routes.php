<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

// Routes pour la gestion des items
$routes->get('item/form', 'ItemController::form'); // Pour l'ajout
$routes->get('item/form/(:num)', 'ItemController::form/$1'); // Pour la modification
$routes->post('item/save', 'ItemController::save');
$routes->get('item/delete/(:num)', 'ItemController::delete/$1');