<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// Page d'accueil du catalogue
$routes->get('/', 'CartesController::index');

// Routes pour le CRUD (Create, Update, Delete)
$routes->post('/create', 'CartesController::create');
$routes->post('/update/(:num)', 'CartesController::update/$1');
$routes->get('/delete/(:num)', 'CartesController::delete/$1');