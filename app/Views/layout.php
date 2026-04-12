<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</head>

<body>
    <header class="main-header">
        <h1>AMFS</h1>

        <div class="user-nav">
            <?php if (auth()->loggedIn()) { ?>
            <span class="welcome-text">👤 <?php echo esc(auth()->user()->username); ?></span>
            <a href="<?php echo base_url('logout'); ?>" class="btn-logout">Déconnexion</a>
            <?php } else { ?>
            <a href="<?php echo base_url('login'); ?>" class="btn-login">Connexion</a>
            <a href="<?php echo base_url('register'); ?>" class="btn-register">Créer un compte</a>
            <?php } ?>
        </div>
    </header>
    <?php if (isset($headers) && !empty($headers)) { ?>
    <nav class="category-nav container">
        <?php foreach ($headers as $h) { ?>
        <a href="<?php echo base_url('categorie/'.$h['id']); ?>"
            class="nav-tab <?php echo (isset($currentHeaderId) && $currentHeaderId == $h['id']) ? 'active' : ''; ?>">
            <?php echo esc($h['nom']); ?>
        </a>
        <?php } ?>
    </nav>
    <?php } ?>
    <main class="container">
        <?php echo view($view ?? 'home'); ?>
    </main>
</body>

</html>