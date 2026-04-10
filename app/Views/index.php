<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Sommaire</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #141414;
        color: white;
        padding: 20px;
        margin: 0;
    }

    h1 {
        margin-top: 0;
    }

    .grid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .carte {
        background: #333;
        border-radius: 8px;
        padding: 15px;
        width: 250px;
        text-align: center;
        position: relative;
    }

    .carte img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Boutons */
    .btn {
        padding: 8px 12px;
        margin-top: 10px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        font-weight: bold;
    }

    .btn-add {
        background: #e50914;
        color: white;
        margin-bottom: 20px;
    }

    .btn-edit {
        background: #f39c12;
        color: white;
    }

    .btn-delete {
        background: #c0392b;
        color: white;
        text-decoration: none;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 13.3px;
    }

    /* Formulaires inputs */
    input,
    textarea {
        width: 100%;
        margin-bottom: 15px;
        padding: 10px;
        box-sizing: border-box;
        background: #333;
        border: 1px solid #555;
        color: white;
        border-radius: 4px;
    }

    /* --- NOUVEAU CSS POUR LES POP-UPS --- */

    /* Le fond sombre derrière la pop-up */
    .modal-overlay {
        display: none;
        /* Caché par défaut */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        z-index: 999;
    }

    /* La fenêtre pop-up centrée */
    .form-modal {
        display: none;
        /* Caché par défaut */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Règle d'or pour centrer parfaitement */
        background: #222;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #444;
        z-index: 1000;
        width: 90%;
        max-width: 400px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.8);
    }

    /* Bouton pour fermer la pop-up (la croix en haut à droite) */
    .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        color: #aaa;
        font-size: 20px;
        cursor: pointer;
    }

    .close-btn:hover {
        color: white;
    }
    </style>
</head>

<body>

    <div id="overlay" class="modal-overlay" onclick="closeAllModals()"></div>

    <h1>Mon Sommaire (Films, Séries, Animés)</h1>

    <?php if (session()->getFlashdata('message')): ?>
    <p style="color: #2ecc71; font-weight: bold;"><?= session()->getFlashdata('message') ?></p>
    <?php endif; ?>

    <button class="btn btn-add" onclick="openModal('form-add')">+ Ajouter une nouvelle carte</button>

    <div id="form-add" class="form-modal">
        <button class="close-btn" onclick="closeAllModals()">&times;</button>
        <h3 style="margin-top: 0;">Ajouter une carte</h3>
        <form action="/create" method="POST">
            <input type="text" name="libelle" placeholder="Titre (ex: Inception)" required>
            <textarea name="description" placeholder="Description" rows="4"></textarea>
            <input type="text" name="url_path" placeholder="URL de redirection (ex: /films/inception)">
            <input type="text" name="img_path" placeholder="Chemin de l'image (ex: assets/img/snk.jpg)">
            <button type="submit" class="btn btn-add" style="width: 100%; margin-bottom: 0;">Sauvegarder</button>
        </form>
    </div>

    <div class="grid">
        <?php foreach ($cartes as $carte): ?>
        <div class="carte">
            <a href="<?= esc($carte['url_path']) ?>">
                <img src="<?= esc($carte['img_path'] ?: 'https://via.placeholder.com/250x150?text=Pas+d+image') ?>"
                    alt="<?= esc($carte['libelle']) ?>">
            </a>
            <h3 style="margin-bottom: 5px;"><?= esc($carte['libelle']) ?></h3>
            <p style="font-size: 0.9em; color: #ccc;"><?= esc($carte['description']) ?></p>

            <button class="btn btn-edit" onclick="openModal('form-edit-<?= $carte['id'] ?>')">Modifier</button>
            <a href="/delete/<?= $carte['id'] ?>" class="btn btn-delete"
                onclick="return confirm('Sûr de vouloir supprimer ?');">Supprimer</a>

            <div id="form-edit-<?= $carte['id'] ?>" class="form-modal">
                <button class="close-btn" onclick="closeAllModals()">&times;</button>
                <h3 style="margin-top: 0; text-align: left;">Modifier <?= esc($carte['libelle']) ?></h3>
                <form action="/update/<?= $carte['id'] ?>" method="POST">
                    <input type="text" name="libelle" value="<?= esc($carte['libelle']) ?>" required>
                    <textarea name="description" rows="4"><?= esc($carte['description']) ?></textarea>
                    <input type="text" name="url_path" value="<?= esc($carte['url_path']) ?>">
                    <input type="text" name="img_path" value="<?= esc($carte['img_path']) ?>">
                    <button type="submit" class="btn btn-edit" style="width: 100%; margin-bottom: 0;">Mettre à
                        jour</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script>
    // Ouvre la pop-up ciblée et affiche le fond sombre
    function openModal(id) {
        document.getElementById('overlay').style.display = 'block';
        document.getElementById(id).style.display = 'block';
    }

    // Ferme tout (fond sombre + toutes les pop-ups)
    function closeAllModals() {
        document.getElementById('overlay').style.display = 'none';
        var modals = document.querySelectorAll('.form-modal');
        modals.forEach(function(modal) {
            modal.style.display = 'none';
        });
    }
    </script>
</body>

</html>