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
    }

    .container {
        text-align: center;
        background: white;
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 10;
        /* Pour que le conteneur reste au dessus du bouton fuyard */
    }

    h1 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 30px;
    }

    input[type="text"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        width: 80%;
        max-width: 300px;
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        position: relative;
        min-height: 60px;
        /* Évite que le conteneur saute quand le bouton grandit */
    }

    .btn {
        padding: 12px 30px;
        font-size: 18px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
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
        position: relative;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Es-tu là pour mon anniversaire ?</h1>

        <form id="inviteForm" action="<?= base_url('anniversaire/confirmation') ?>" method="post">

            <!-- LE CHAMP CACHÉ MANQUANT EST ICI 👇 -->
            <input type="hidden" name="nom" value="<?= esc($nom) ?>">

            <!-- Champ caché pour stocker le nombre de tentatives -->
            <input type="hidden" name="tentatives_non" id="tentativesInput" value="0">

            <div class="buttons-container">
                <button type="submit" class="btn btn-yes" id="btnOui">Oui !</button>
                <button type="button" class="btn btn-no" id="btnNon" tabindex="-1">Non...</button>
            </div>
        </form>
    </div>

    <script>
    const btnNon = document.getElementById('btnNon');
    const btnOui = document.getElementById('btnOui');
    const form = document.getElementById('inviteForm');
    const tentativesInput = document.getElementById('tentativesInput'); // Récupère le champ caché

    const phrasesTrolls = [
        "Tu es sûr ?",
        "Réfléchis bien...",
        "Mauvaise réponse !",
        "Allez, dis oui...",
        "Tu vas rater ça ?",
        "Clique sur le vert !"
    ];
    let compteurEsquive = 0;

    btnNon.addEventListener('mouseover', function() {


        // 1. Déplacement aléatoire
        this.style.position = 'fixed';
        const x = Math.random() * (window.innerWidth - this.clientWidth);
        const y = Math.random() * (window.innerHeight - this.clientHeight);
        this.style.left = `${x}px`;
        this.style.top = `${y}px`;

        // 2. Mise à jour du compteur et du champ caché
        compteurEsquive++; // On incrémente
        tentativesInput.value = compteurEsquive; // On met à jour la valeur envoyée en POST

        // 3. Troll textuel
        this.innerText = phrasesTrolls[compteurEsquive % phrasesTrolls.length];

        // 4. Le bouton Oui devient énorme
        let currentYesSize = window.getComputedStyle(btnOui).fontSize;
        let currentYesPaddingX = window.getComputedStyle(btnOui).paddingLeft;
        let currentYesPaddingY = window.getComputedStyle(btnOui).paddingTop;

        if (parseFloat(currentYesSize) < 60) {
            btnOui.style.fontSize = (parseFloat(currentYesSize) + 4) + 'px';
            btnOui.style.padding = (parseFloat(currentYesPaddingY) + 2) + 'px ' + (parseFloat(
                currentYesPaddingX) + 6) + 'px';
        }

        // 5. Le bouton Non rétrécit
        let currentNoSize = window.getComputedStyle(this).fontSize;
        if (parseFloat(currentNoSize) > 8) {
            this.style.fontSize = (parseFloat(currentNoSize) - 1) + 'px';
            this.style.padding = '8px 15px';
        }
    });

    // Anti-Ninja
    btnNon.addEventListener('click', function(e) {
        e.preventDefault();
        alert(
            "Erreur système 404 : La réponse 'Non' a été supprimée d'internet. Redirection vers le bon choix..."
        );

        // C'est cette ligne qui manquait pour valider le troll !
        btnOui.click();
    });
    </script>
</body>

</html>