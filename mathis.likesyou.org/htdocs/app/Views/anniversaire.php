<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Anniversaire</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f3f4f6;
        overflow: hidden;
        /* Empêche l'apparition des barres de défilement quand le bouton part loin */
    }

    .container {
        text-align: center;
        background: white;
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
        margin-bottom: 40px;
        color: #333;
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        position: relative;
        /* Garde les boutons alignés initialement */
    }

    .btn {
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-yes {
        background-color: #4CAF50;
        color: white;
    }

    .btn-yes:hover {
        background-color: #45a049;
    }

    .btn-no {
        background-color: #f44336;
        color: white;
        /* Une petite transition fluide pour le déplacement */
        transition: top 0.2s ease, left 0.2s ease;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Es-tu là pour mon anniversaire ?</h1>

        <form action="<?= base_url('anniversaire/confirmation') ?>" method="post">
            <div class="buttons-container">
                <button type="submit" class="btn btn-yes">Oui !</button>

                <!-- type="button" évite de soumettre le formulaire par erreur si on le clique -->
                <button type="button" class="btn btn-no" id="btnNon" tabindex="-1">Non...</button>
            </div>
        </form>
    </div>

    <script>
    const btnNon = document.getElementById('btnNon');

    // Détecte quand la souris passe sur le bouton
    btnNon.addEventListener('mouseover', function() {
        // Passe le bouton en 'fixed' pour qu'il puisse aller n'importe où sur l'écran
        this.style.position = 'fixed';

        // Calcule des coordonnées aléatoires en gardant le bouton dans la fenêtre
        const x = Math.random() * (window.innerWidth - this.clientWidth);
        const y = Math.random() * (window.innerHeight - this.clientHeight);

        // Applique les nouvelles coordonnées
        this.style.left = `${x}px`;
        this.style.top = `${y}px`;
    });
    </script>
</body>

</html>