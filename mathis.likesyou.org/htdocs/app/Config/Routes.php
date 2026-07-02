<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// app/Config/Routes.php

// app/Config/Routes.php

// 1. La route pour recevoir les données du formulaire (le clic sur "Oui")
$routes->post('anniversaire/confirmation', 'Anniversaire::confirmation');

// 2. Les routes pour afficher la page (Méthode 2)
// Note : on place le post AVANT le get avec le (:segment) par précaution
$routes->get('anniversaire/(:segment)', 'Anniversaire::index/$1');
$routes->get('anniversaire', 'Anniversaire::index');