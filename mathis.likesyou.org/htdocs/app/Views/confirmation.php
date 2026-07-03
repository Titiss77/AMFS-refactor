<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C'est noté !</title>
    <!-- On garde la même police mignonne -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Quicksand', 'Segoe UI', Tahoma, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        /* Le même dégradé rose/pêche en fond */
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 99%, #fecfef 100%);
        overflow: hidden;
    }

    .container {
        text-align: center;
        background: rgba(255, 255, 255, 0.95);
        padding: 50px 40px;
        border-radius: 30px;
        box-shadow: 0 15px 35px rgba(255, 105, 180, 0.2);
        border: 3px solid #ffe4e1;
        max-width: 500px;
        z-index: 10;
        animation: popIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    h1 {
        margin-bottom: 15px;
        color: #ff1493;
        font-weight: 700;
        font-size: 2.2em;
        text-shadow: 1px 1px 2px rgba(255, 105, 180, 0.2);
    }

    p {
        font-size: 1.2em;
        color: #444;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .highlight {
        color: #ff0844;
        font-weight: bold;
        font-size: 1.2em;
    }

    .btn-yes {
        background: linear-gradient(45deg, #ff0844 0%, #ffb199 100%);
        color: white;
        padding: 15px 35px;
        font-size: 18px;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 6px 15px rgba(255, 8, 68, 0.4);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-yes:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(255, 8, 68, 0.6);
    }

    /* Petite animation d'apparition */
    @keyframes popIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Génial <?= esc($nom) ?> ! 💖</h1>
        <p>
            C'est bien enregistré, tu as officiellement dit oui !<br><br>
            <?php if ($tentatives > 0): ?>
            Mention spéciale : tu as quand même essayé de cliquer sur "Non" <span
                class="highlight"><?= esc($tentatives) ?> fois</span>.<br>
            Bel effort, mais la fatalité triomphe toujours ! 😉
            <?php else: ?>
            Tu as cliqué sur "Oui" du premier coup. Quel choix parfait ! 🥰
            <?php endif; ?>
        </p>
        <a href="<?= base_url('/') ?>" class="btn-yes">Retour</a>
    </div>
</body>

</html>