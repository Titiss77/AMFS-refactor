<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
    <title>AMFS - Mes Cartes</title>
</head>

<body style="background-color: var(--fond-page); font-family: sans-serif; margin: 0; padding: 20px;">
    <header style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: var(--couleur-principale);">AMFS Dashboard</h1>
    </header>
    <main>
        <?php 
        // Affiche la vue transmise par le contrôleur
        echo view($view ?? 'home'); 
        ?>
    </main>
</body>

</html>