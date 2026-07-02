<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation troll</title>
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
    }

    .btn-admin-secret {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #333;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.2s;
        z-index: 100;
    }

    .btn-admin-secret:hover {
        background-color: #555;
    }
    </style>
</head>

<body>
    <!-- LE BOUTON SECRET APPARAÎT ICI SEULEMENT SI L'IP EST AUTORISÉE -->
    <?php if (isset($estAdmin) && $estAdmin): ?>
    <a href="<?= base_url('troll/resultats') ?>" class="btn-admin-secret">⚙️ Voir les résultats</a>
    <?php endif; ?>

    <div class="container">
        <h1>Es-tu là pour mon troll ?</h1>

        <form id="inviteForm" action="<?= base_url('troll/confirmation') ?>" method="post">

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
    const tentativesInput = document.getElementById('tentativesInput');

    const phrasesTrolls = [
        "Tu es sûr ?",
        "Réfléchis bien...",
        "Mauvaise réponse !",
        "Allez, dis oui...",
        "Tu vas rater ça ?",
        "Clique sur le vert !"
    ];
    let compteurEsquive = 0;

    // On crée une fonction unique pour faire fuir le bouton
    function faireFuirBouton(e) {
        // Si c'est un écran tactile, on empêche le "clic" natif de se déclencher
        if (e.type === 'touchstart') {
            e.preventDefault();
        }

        // 1. Déplacement aléatoire (avec une petite marge pour ne pas sortir de l'écran mobile)
        this.style.position = 'fixed';
        const margin = 20;
        const x = Math.random() * (window.innerWidth - this.clientWidth - margin * 2) + margin;
        const y = Math.random() * (window.innerHeight - this.clientHeight - margin * 2) + margin;

        this.style.left = `${x}px`;
        this.style.top = `${y}px`;

        // 2. Mise à jour du compteur
        compteurEsquive++;
        tentativesInput.value = compteurEsquive;

        // 3. Troll textuel
        this.innerText = phrasesTrolls[compteurEsquive % phrasesTrolls.length];

        // 4. Le bouton Oui devient énorme
        let currentYesSize = window.getComputedStyle(btnOui).fontSize;
        let currentYesPaddingX = window.getComputedStyle(btnOui).paddingLeft;
        let currentYesPaddingY = window.getComputedStyle(btnOui).paddingTop;

        if (parseFloat(currentYesSize) < 60) {
            btnOui.style.fontSize = (parseFloat(currentYesSize) + 4) + 'px';
            btnOui.style.padding = (parseFloat(currentYesPaddingY) + 2) + 'px ' + (parseFloat(currentYesPaddingX) + 6) +
                'px';
        }

        // 5. Le bouton Non rétrécit (mais pas trop petit pour mobile !)
        let currentNoSize = window.getComputedStyle(this).fontSize;
        if (parseFloat(currentNoSize) > 12) { // Limite fixée à 12px au lieu de 8px pour les écrans de téléphone
            this.style.fontSize = (parseFloat(currentNoSize) - 1) + 'px';
            this.style.padding = '8px 15px';
        }
    }

    // On écoute le survol pour les PC ET le toucher pour les smartphones
    btnNon.addEventListener('mouseover', faireFuirBouton);
    btnNon.addEventListener('touchstart', faireFuirBouton, {
        passive: false
    });

    // Anti-Ninja (pour ceux qui trichent au clavier avec la touche Tab)
    btnNon.addEventListener('click', function(e) {
        e.preventDefault();
        alert(
            "Erreur système 404 : La réponse 'Non' a été supprimée d'internet. Redirection vers le bon choix..."
        );
        btnOui.click();
    });
    </script>
</body>

</html>