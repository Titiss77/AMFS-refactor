<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// app/Config/Routes.php

// app/Config/Routes.php

// 1. La route pour recevoir les données du formulaire (le clic sur "Oui")
$routes->post('troll/confirmation', 'Troll::confirmation');

// 2. Les routes pour afficher la page (Méthode 2)
// Note : on place le post AVANT le get avec le (:segment) par précaution
$routes->get('troll/(:segment)', 'Troll::index/$1');
$routes->get('troll', 'Troll::index');