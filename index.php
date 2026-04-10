<?php
// AMFS-refactor/index.php
session_start();

// Chargement des classes (Autoloader basique)
require_once 'config/Env.php';
require_once 'config/Database.php';
require_once 'src/Models/ItemModel.php';
require_once 'src/Controllers/HomeController.php';

// Chargement des variables d'environnement
Env::load(__DIR__ . '/.env');

// Routage très basique
$action = $_GET['action'] ?? 'home';

if ($action === 'home') {
    $controller = new HomeController();
    $controller->index();
} else {
    echo "Page introuvable";
}