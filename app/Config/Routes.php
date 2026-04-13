<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// @var RouteCollection $routes

// Pages publiques (accessibles sans être connecté)
$routes->get('/', 'HomeController::index');
$routes->get('categorie/(:num)', 'HomeController::categorie/$1'); // <-- DÉPLACÉ ICI

// Routes protégées par l'authentification Shield
$routes->group('', ['filter' => 'session'], static function ($routes): void {
    $routes->get('item/form', 'ItemController::form');
    $routes->get('item/form/(:num)', 'ItemController::form/$1');
    $routes->post('item/save', 'ItemController::save');
    $routes->get('item/delete/(:num)', 'ItemController::delete/$1');
    $routes->post('item/increment-episode/(:num)', 'ItemController::incrementEpisode/$1');
});

service('auth')->routes($routes);