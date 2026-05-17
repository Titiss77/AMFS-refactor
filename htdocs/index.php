<?php

// A standard associative array variable
$chemin = [
    'amfs.is-best.net' => [
        'chemin' => 'http://perso.local/amfs.is-best.net/htdocs/',
    ],
];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes</title>
</head>

<body>
    <h1>Liste des chemins</h1>
    <ul>
        <?php foreach ($chemin as $key => $value) { ?>
        <li><strong><?php echo $key; ?>:</strong> <?php echo $value['chemin']; ?></li>
        <a href="<?php echo $value['chemin']; ?>">Visiter</a>
        <?php } ?>
    </ul>

</body>

</html>