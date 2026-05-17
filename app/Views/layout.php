<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/root.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="csrf-header" content="<?= csrf_header() ?>">

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
    // On passe les variables PHP au moteur JavaScript
    const amfsConfig = {
        updateOrderUrl: "<?php echo base_url('items/update-order'); ?>",
        csrfHeader: "<?php echo csrf_header(); ?>",
        csrfToken: "<?php echo csrf_hash(); ?>"
    };
    </script>
    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</head>

<body>
    <div id="toast-container" class="toast-container"></div>
    <header class="main-header">
        <h1><a href=" <?php echo base_url('/'); ?>">AMFS</a></h1>

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
        <a href="<?php echo base_url('categorie/' . $h['id']); ?>"
            class="nav-tab <?php echo (isset($currentHeaderId) && $currentHeaderId == $h['id']) ? 'active' : ''; ?>">
            <?php echo esc($h['nom']); ?>
        </a>
        <?php } ?>
    </nav>
    <?php } ?>
    <main class="container">
        <?php echo $this->renderSection('content'); ?>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = new URL(window.location.href);

        if (currentUrl.searchParams.has('open') || currentUrl.hash) {
            setTimeout(() => {
                window.history.replaceState({}, document.title, currentUrl.pathname);
            }, 10);
        }
    });
    </script>
</body>

</html>