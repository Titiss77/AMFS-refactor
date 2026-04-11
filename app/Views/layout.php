<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body>
    <header class="main-header">
        <h1>AMFS Dashboard</h1>

        <div class="user-nav">
            <?php if (auth()->loggedIn()) : ?>
            <span class="welcome-text">👤 Bienvenue, <?= esc(auth()->user()->username) ?></span>
            <a href="<?= base_url('logout') ?>" class="btn-logout">Déconnexion</a>
            <?php else : ?>
            <a href="<?= base_url('login') ?>" class="btn-login">Connexion</a>
            <a href="<?= base_url('register') ?>" class="btn-register">Créer un compte</a>
            <?php endif; ?>
        </div>
    </header>
    <?php if (isset($headers) && !empty($headers)) : ?>
    <nav class="category-nav container">
        <?php foreach ($headers as $h) : ?>
        <a href="<?= base_url('categorie/' . $h['id']) ?>"
            class="nav-tab <?= (isset($currentHeaderId) && $currentHeaderId == $h['id']) ? 'active' : '' ?>">
            <?= esc($h['nom']) ?>
        </a>
        <?php endforeach; ?>
    </nav>
    <?php endif; ?>
    <main class="container">
        <?php echo view($view ?? 'home'); ?>
    </main>
</body>

</html>