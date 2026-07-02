<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation 💕</title>

    <!-- Importation d'une police mignonne et arrondie -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

    <style>
    body {
        font-family: 'Quicksand', 'Segoe UI', Tahoma, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        /* Un beau dégradé rose/pêche en fond */
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
        overflow: hidden;
    }

    .container {
        text-align: center;
        /* Fond légèrement transparent */
        background: rgba(255, 255, 255, 0.95);
        padding: 50px;
        border-radius: 30px;
        /* Bords très arrondis */
        /* Ombre rose douce */
        box-shadow: 0 15px 35px rgba(255, 105, 180, 0.2);
        border: 3px solid #ffe4e1;
        z-index: 10;
    }

    h1 {
        margin-bottom: 25px;
        /* Couleur rose fuchsia */
        color: #ff1493;
        font-weight: 700;
        font-size: 2.2em;
        text-shadow: 1px 1px 2px rgba(255, 105, 180, 0.2);
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        position: relative;
        min-height: 70px;
    }

    .btn {
        padding: 15px 35px;
        font-size: 18px;
        font-weight: 700;
        border: none;
        /* Bords en forme de pilule */
        border-radius: 50px;
        cursor: pointer;
        /* Effet de transition rebondissant très fluide */
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        font-family: 'Quicksand', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-yes {
        /* Dégradé de couleurs chaudes pour le OUI */
        background: linear-gradient(45deg, #ff0844 0%, #ffb199 100%);
        color: white;
        box-shadow: 0 6px 15px rgba(255, 8, 68, 0.4);
    }

    .btn-yes:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(255, 8, 68, 0.6);
    }

    .btn-no {
        /* Dégradé violet pastel pour le NON */
        background: linear-gradient(45deg, #a18cd1 0%, #fbc2eb 100%);
        color: white;
        position: relative;
        box-shadow: 0 6px 15px rgba(161, 140, 209, 0.4);
    }

    /* Le Bouton Admin Secret Relooké */
    .btn-admin-secret {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #ff69b4;
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 10px rgba(255, 105, 180, 0.4);
        border: 2px solid white;
        transition: all 0.2s ease;
        z-index: 100;
    }

    .btn-admin-secret:hover {
        background: #ff1493;
        transform: translateY(-2px) scale(1.05);
    }
    </style>
</head>

<body>

    <!-- BOUTON SECRET (Visible seulement si l'IP est autorisée) -->
    <?php if (isset($estAdmin) && $estAdmin): ?>
    <a href="<?= base_url('troll/resultats') ?>" class="btn-admin-secret">✨ Voir les résultats</a>
    <?php endif; ?>

    <div class="container">
        <h1>Es-tu là pour mon troll ? 💖</h1>

        <form id="inviteForm" action="<?= base_url('troll/confirmation') ?>" method="post">

            <input type="hidden" name="nom" value="<?= esc($nom) ?>">
            <input type="hidden" name="tentatives_non" id="tentativesInput" value="0">

            <div class="buttons-container">
                <button type="submit" class="btn btn-yes" id="btnOui">Oui ! 🥰</button>
                <button type="button" class="btn btn-no" id="btnNon" tabindex="-1">Non... 🥺</button>
            </div>
        </form>
    </div>

    <script>
    const btnNon = document.getElementById('btnNon');
    const btnOui = document.getElementById('btnOui');
    const form = document.getElementById('inviteForm');
    const tentativesInput = document.getElementById('tentativesInput');

    // Phrases modifiées pour coller à la nouvelle ambiance !
    const phrasesTrolls = [
        "T'es sûr(e) ? 🥺",
        "Mais euh... 💔",
        "Trop lent(e) ! 🤭",
        "Allez dis oui... ✨",
        "Tu vas me manquer ! 😭",
        "Clique sur le rose ! 💕"
    ];
    let compteurEsquive = 0;

    function faireFuirBouton(e) {
        if (e.type === 'touchstart') {
            e.preventDefault();
        }

        this.style.position = 'fixed';
        const margin = 20;
        const x = Math.random() * (window.innerWidth - this.clientWidth - margin * 2) + margin;
        const y = Math.random() * (window.innerHeight - this.clientHeight - margin * 2) + margin;

        this.style.left = `${x}px`;
        this.style.top = `${y}px`;

        compteurEsquive++;
        tentativesInput.value = compteurEsquive;
        this.innerText = phrasesTrolls[compteurEsquive % phrasesTrolls.length];

        let currentYesSize = window.getComputedStyle(btnOui).fontSize;
        let currentYesPaddingX = window.getComputedStyle(btnOui).paddingLeft;
        let currentYesPaddingY = window.getComputedStyle(btnOui).paddingTop;

        if (parseFloat(currentYesSize) < 60) {
            btnOui.style.fontSize = (parseFloat(currentYesSize) + 4) + 'px';
            btnOui.style.padding = (parseFloat(currentYesPaddingY) + 2) + 'px ' + (parseFloat(currentYesPaddingX) + 6) +
                'px';
        }

        let currentNoSize = window.getComputedStyle(this).fontSize;
        if (parseFloat(currentNoSize) > 12) {
            this.style.fontSize = (parseFloat(currentNoSize) - 1) + 'px';
            this.style.padding = '8px 15px';
        }
    }

    btnNon.addEventListener('mouseover', faireFuirBouton);
    btnNon.addEventListener('touchstart', faireFuirBouton, {
        passive: false
    });

    btnNon.addEventListener('click', function(e) {
        e.preventDefault();
        alert("Erreur système 404 : La méchanceté a été bloquée. Redirection vers l'amour et la joie... 💖");
        btnOui.click();
    });
    </script>
</body>

</html>