<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS</title>

    <script>
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        document.documentElement.setAttribute('data-bs-theme', 'dark'); // <-- Ajout pour Bootstrap 5
    }
    </script>

    <link rel="stylesheet" href="<?php echo base_url('assets/root.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <meta name="csrf-token" content="<?php echo csrf_hash(); ?>">
    <meta name="csrf-header" content="<?php echo csrf_header(); ?>">
    <meta name="theme-color" content="#fcfcfd" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#09090b" media="(prefers-color-scheme: dark)">

    <script>
    window.amfsConfig = {
        "baseUrl": "<?php echo rtrim(base_url(), '/') . '/'; ?>",
        "updateOrderUrl": "<?php echo base_url('items/update-order'); ?>",
        "cronUrl": "<?php echo base_url('cron/run'); ?>",
        "csrfHeader": "<?php echo csrf_header(); ?>",
        "csrfToken": "<?php echo csrf_hash(); ?>",
        "tmdbApiKey": "9774091bee3bd236f4438cd6d8caa8d8"
    };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js" defer></script>
    <script src="<?php echo base_url('assets/script.js?v=' . time()); ?>" defer></script>
</head>

<body>
    <div id="toast-container" class="toast-container"></div>

    <header class="main-header">
        <h1><a href="<?php echo base_url('/'); ?>" style="color:inherit;">AMFS</a></h1>

        <div class="user-nav">
            <button id="theme-toggle" class="btn-theme">🌙 Sombre</button>

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

        // Interception des Flashdata de CodeIgniter 4 pour lancer des Toasts automatiquement
        <?php if (session()->getFlashdata('success')): ?>
        showToast("<?php echo esc(session()->getFlashdata('success')); ?>", "success");
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
        showToast("<?php echo esc(session()->getFlashdata('error')); ?>", "danger");
        <?php endif ?>

        <?php if (session()->getFlashdata('message')): ?>
        showToast("<?php echo esc(session()->getFlashdata('message')); ?>", "info");
        <?php endif ?>
    });

    // Cron Job silencieux
    window.addEventListener('load', function() {
        setTimeout(function() {
            fetch('<?php echo base_url('cron/run'); ?>')
                .catch(error => console.log('Tâche de fond ignorée.'));
        }, 5000);
    });
    </script>
</body>

</html>