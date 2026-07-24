<?php
// Configuration sécurisée des cookies de session avant le démarrage
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Strict');

session_start();

require_once 'controllers/MetricController.php';
require_once 'controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$authController = new AuthController();

// Gestion des routes publiques
if ($action === 'login') {
    $authController->login();
    exit();
} elseif ($action === 'register') {
    $authController->register();
    exit();
} elseif ($action === 'logout') {
    $authController->logout();
    exit();
}

// Vérification stricte de l'authentification pour toutes les autres actions
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit();
}

// Gestion des routes protégées
$controller = new MetricController();
if ($action === 'save') {
    $controller->save();
} else {
    $controller->index();
}