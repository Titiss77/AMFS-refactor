<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <title>AMFS - Mes Cartes</title>
</head>

<body style="background-color: var(--fond-page); font-family: sans-serif; margin: 0; padding: 20px;">
    <header
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; padding-bottom: 10px; border-bottom: 1px solid #ccc;">
        <h1 style="color: var(--couleur-principale); margin: 0;">AMFS Dashboard</h1>

        <div>
            <?php if (auth()->loggedIn()) : ?>
            <span style="margin-right: 15px; font-weight: bold;">
                👤 Bienvenue, <?= auth()->user()->username ?>
            </span>
            <a href="<?= base_url('logout') ?>" style="color: red; text-decoration: none;">Déconnexion</a>
            <?php else : ?>
            <a href="<?= base_url('login') ?>"
                style="margin-right: 15px; text-decoration: none; color: blue;">Connexion</a>
            <a href="<?= base_url('register') ?>"
                style="text-decoration: none; background: #007bff; color: white; padding: 5px 10px; border-radius: 5px;">Créer
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