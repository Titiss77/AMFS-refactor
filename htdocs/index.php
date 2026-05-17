<?php
// 1. Éviter la boucle infinie : Si on est déjà dans un sous-projet, on s'arrête là
if (defined('DYNAMIC_ROUTING_ACTIVE')) {
    return; 
}

// 2. Récupérer l'URL de base
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$baseUrl = $protocol . $_SERVER['HTTP_HOST'];

// 3. Trouver le dossier parent (AMFS-refactor)
$parentDir = dirname(__DIR__); 

$projets = [];

// 4. Scanner le dossier parent pour lister les sous-projets
if (is_dir($parentDir)) {
    $elements = scandir($parentDir);
    
    foreach ($elements as $element) {
        if ($element === '.' || $element === '..' || $element === 'htdocs') {
            continue;
        }
        
        $cheminProjet = $parentDir . '/' . $element;
        
        if (is_dir($cheminProjet) && is_dir($cheminProjet . '/htdocs')) {
            $projets[$element] = $baseUrl . '/index.php?projet=' . urlencode($element);
        }
    }
}

// 5. GESTION DU CHARGEMENT DU SOUS-PROJET
if (isset($_GET['projet']) && isset($projets[$_GET['projet']])) {
    $projetCible = $_GET['projet'];
    $targetIndex = $parentDir . '/' . $projetCible . '/htdocs/index.php';
    
    if (file_exists($targetIndex)) {
        // On définit la constante pour bloquer la récursion
        define('DYNAMIC_ROUTING_ACTIVE', true);
        
        // On change le répertoire de travail pour que le sous-projet trouve ses assets
        chdir(dirname($targetIndex));
        
        // On inclut le VRAI index.php du sous-projet
        include($targetIndex);
        exit;
    }
}

// 6. AFFICHAGE DE L'ACCUEIL (Si aucun projet n'est sélectionné)
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Hub Local - AMFS Refactor</title>
    <style>
    body {
        font-family: sans-serif;
        background: #f4f6f9;
        padding: 40px;
        color: #333;
    }

    .container {
        max-width: 600px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 0 auto;
    }

    h1 {
        color: #007bff;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin: 10px 0;
    }

    a {
        display: block;
        padding: 12px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
        transition: 0.2s;
    }

    a:hover {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Projets AMFS Détectés jsp</h1>

        <?php if (empty($projets)): ?>
        <p>Aucun dossier projet avec un sous-dossier <code>htdocs</code> n'a été trouvé.</p>
        <?php else: ?>
        <ul>
            <?php foreach ($projets as $nom => $lien): ?>
            <li>
                <a href="<?php echo $lien; ?>">📁 <?php echo $nom; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>

</body>

</html>