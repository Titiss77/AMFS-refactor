<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/root.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <meta name="csrf-token" content="<?php echo csrf_hash(); ?>">
    <meta name="csrf-header" content="<?php echo csrf_header(); ?>">

    <script>
    window.amfsConfig = {
        // On s'assure que l'URL de base se termine toujours par un slash pour éviter les bugs
        baseUrl: "<?php echo rtrim(base_url(), '/') . '/'; ?>",
        updateOrderUrl: "<?php echo base_url('items/update-order'); ?>",
        cronUrl: "<?php echo base_url('cron/run'); ?>",
        csrfHeader: "<?php echo csrf_header(); ?>",
        csrfToken: "<?php echo csrf_hash(); ?>",
        tmdbApiKey: "9774091bee3bd236f4438cd6d8caa8d8"
    };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js" defer></script>

    <script src="<?php echo base_url('assets/script.js?v=' . time()); ?>" defer></script>
</head>

<body>
    <div id="toast-container" class="toast-container"></div>
    <header class="main-header">
        <h1><a href=" <?php echo base_url('/'); ?>">AMFS</a></h1>

        <div class="user-nav">
            <?php if (auth()->loggedIn()) { ?>
            <?php if (auth()->user()->inGroup('admin', 'superadmin')) { ?>
            <a href="<?php echo base_url('audit'); ?>" style="color: #80808099; font-size: small;">logs</a>
            <?php } ?>
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

    // Le script attend 5 secondes après le chargement total de la page
    // pour ne pas ralentir l'expérience de l'utilisateur, puis appelle le Cron.
    window.addEventListener('load', function() {
        setTimeout(function() {
            fetch('<?php echo base_url('cron/run'); ?>')
                .catch(error => console.log('Tâche de fond ignorée.'));
        }, 5000);
    });
    </script>
</body>

</html>
</body>

</html>