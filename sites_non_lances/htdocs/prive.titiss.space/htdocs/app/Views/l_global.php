<?php
$menuItems = [
    '/' => 'Accueil',
    '/seances' => 'Les séances',
    '/historique' => 'Historique',
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sommaire des Liens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
</head>

<body>
    <div class="container py-5">
        <?= $this->renderSection('contenu') ?>
    </div>
</body>

</html>