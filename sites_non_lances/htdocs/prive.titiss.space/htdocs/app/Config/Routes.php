<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Sommaire::index');

// Routes pour le CRUD
$routes->get('ajouter', 'Sommaire::formulaire');          // Afficher form vide
$routes->get('modifier/(:num)', 'Sommaire::formulaire/$1'); // Afficher form rempli
$routes->post('sauvegarder', 'Sommaire::sauvegarder');    // Traitement formulaire
$routes->get('supprimer/(:num)', 'Sommaire::supprimer/$1'); // Action supprimer