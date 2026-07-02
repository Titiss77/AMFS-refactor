<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// app/Config/Routes.php

// app/Config/Routes.php

// app/Config/Routes.php

// La route pour les résultats (à placer AVANT la route avec le segment)
$routes->get('troll/resultats', 'Troll::resultats');

$routes->post('troll/confirmation', 'Troll::confirmation');
$routes->get('troll/(:segment)', 'Troll::index/$1');
$routes->get('troll', 'Troll::index');