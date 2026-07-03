<?php
// index.php

// Affichage des erreurs pour le développement (à désactiver en production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Chargement du contrôleur
require_once __DIR__ . '/Controller/SystemController.php';

// Instanciation et exécution
$app = new SystemController();
$app->index();