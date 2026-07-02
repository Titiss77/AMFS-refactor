<?php

declare(strict_types=1);

use CodeIgniter\Router\RouteCollection;

// app/Config/Routes.php

$routes->get('/', 'Anniversaire::index');
$routes->post('anniversaire/confirmation', 'Anniversaire::confirmation');