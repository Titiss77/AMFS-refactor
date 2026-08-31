<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

$routes->get('troll/resultats', 'Troll::resultats');
$routes->post('troll/confirmation', 'Troll::confirmation');

// Nouvelle route qui capture : /troll/Prenom/La_question
$routes->get('troll/(:segment)/(:any)', 'Troll::index/$1/$2'); 
$routes->get('troll/(:segment)', 'Troll::index/$1');
$routes->get('/', 'Troll::index');