<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMFS - Mes Cartes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body
    style="background-color: var(--fond-page); font-family: sans-serif; color: var(--texte-principal); margin: 0; padding: 20px;">

    <header style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: var(--couleur-principale);">AMFS Dashboard</h1>
    </header>

    <main>
        <?php 
            // On inclut la vue spécifique demandée par le contrôleur
            require_once 'views/home.php'; 
        ?>
    </main>

</body>

</html>