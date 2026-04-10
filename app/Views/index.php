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
    }

    .carte img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn {
        padding: 8px 12px;
        margin-top: 10px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
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
    }

    .form-modal {
        display: none;
        background: #222;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #444;
    }

    input,
    textarea {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        box-sizing: border-box;
    }
    </style>
</head>

<body>

    <h1>Mon Sommaire (Films, Séries, Animés)</h1>

    <?php if (session()->getFlashdata('message')): ?>
    <p style="color: #2ecc71;"><?= session()->getFlashdata('message') ?></p>
    <?php endif; ?>

    <button class="btn btn-add" onclick="toggleForm('form-add')">+ Ajouter une nouvelle carte</button>

    <div id="form-add" class="form-modal">
        <h3>Ajouter une carte</h3>
        <form action="/create" method="POST">
            <input type="text" name="libelle" placeholder="Titre (ex: Inception)" required>
            <textarea name="description" placeholder="Description"></textarea>
            <input type="text" name="url_path" placeholder="URL de redirection (ex: /films/inception)">
            <input type="text" name="img_path" placeholder="Chemin de l'image (ex: assets/img/snk.jpg)">
            <button type="submit" class="btn btn-add">Sauvegarder</button>
        </form>
    </div>

    <div class="grid">
        <?php foreach ($cartes as $carte): ?>
        <div class="carte">
            <a href="<?= esc($carte['url_path']) ?>">
                <img src="<?= esc($carte['img_path'] ?: 'https://via.placeholder.com/250x150?text=Pas+d+image') ?>"
                    alt="<?= esc($carte['libelle']) ?>">
            </a>
            <h3><?= esc($carte['libelle']) ?></h3>
            <p><?= esc($carte['description']) ?></p>

            <button class="btn btn-edit" onclick="toggleForm('form-edit-<?= $carte['id'] ?>')">Modifier</button>

            <a href="/delete/<?= $carte['id'] ?>" class="btn btn-delete"
                onclick="return confirm('Sûr de vouloir supprimer ?');">Supprimer</a>

            <div id="form-edit-<?= $carte['id'] ?>" class="form-modal" style="margin-top: 15px;">
                <form action="/update/<?= $carte['id'] ?>" method="POST">
                    <input type="text" name="libelle" value="<?= esc($carte['libelle']) ?>" required>
                    <textarea name="description"><?= esc($carte['description']) ?></textarea>
                    <input type="text" name="url_path" value="<?= esc($carte['url_path']) ?>">
                    <input type="text" name="img_path" value="<?= esc($carte['img_path']) ?>">
                    <button type="submit" class="btn btn-edit">Mettre à jour</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <script>
    function toggleForm(id) {
        var form = document.getElementById(id);
        if (form.style.display === "block") {
            form.style.display = "none";
        } else {
            form.style.display = "block";
        }
    }
    </script>
</body>

</html>