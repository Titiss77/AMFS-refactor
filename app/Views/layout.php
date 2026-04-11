<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <title>AMFS - Mes Cartes</title>
</head>

<body>
    <header>
        <h1>AMFS Dashboard</h1>

        <div>
            <?php if (auth()->loggedIn()) : ?>
            <span>
                👤 Bienvenue, <?= auth()->user()->username ?>
            </span>
            <a href="<?= base_url('logout') ?>">Déconnexion</a>
            <?php else : ?>
            <a href="<?= base_url('login') ?>">Connexion</a>
            <a href="<?= base_url('register') ?>">Créer
                un compte</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <?php
        // Affiche la vue transmise par le contrôleur
        echo view($view ?? 'home');
    ?>
    </main>
</body>

</html>