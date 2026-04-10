<?php
// AMFS-refactor/index.php
session_start();

require_once 'config/Env.php';
require_once 'config/Database.php';
require_once 'src/Models/ItemModel.php';
require_once 'src/Controllers/HomeController.php';
require_once 'src/Controllers/ItemController.php'; // Ajout

Env::load(__DIR__ . '/.env');

$action = $_GET['action'] ?? 'home';

// Système de routage simple
if ($action === 'home') {
    $controller = new HomeController();
    $controller->index();
} elseif ($action === 'form') {
    $controller = new ItemController();
    $controller->form();
} elseif ($action === 'save') {
    $controller = new ItemController();
    $controller->save();
} elseif ($action === 'delete') {
    $controller = new ItemController();
    $controller->delete();
} else {
    echo "Page introuvable";
}