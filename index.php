<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// AMFS-refactor/index.php
session_start();

require_once 'config/Env.php';

require_once 'config/Database.php';

require_once 'src/models/ItemModel.php';

require_once 'src/controllers/HomeController.php';

require_once 'src/controllers/ItemController.php';

Env::load(__DIR__.'/.env');

$action = $_GET['action'] ?? 'home';

// Système de routage simple
if ('home' === $action) {
    $controller = new HomeController();
    $controller->index();
} elseif ('form' === $action) {
    $controller = new ItemController();
    $controller->form();
} elseif ('save' === $action) {
    $controller = new ItemController();
    $controller->save();
} elseif ('delete' === $action) {
    $controller = new ItemController();
    $controller->delete();
} else {
    echo 'Page introuvable';
}
