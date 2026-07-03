<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Invitations</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 40px;
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 10px;
        margin-top: 0;
    }

    .admin-info {
        color: #666;
        font-size: 0.9em;
        margin-bottom: 20px;
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .tentatives {
        font-weight: bold;
        color: #f44336;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Liste des invités confirmés 🎉</h1>

        <div class="admin-info">
            Connecté en tant qu'Admin (IP Autorisée : <?= esc($mon_ip) ?>)
        </div>

        <table>
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Question posée</th>
                    <th>Réponse</th>
                    <th>Tentatives d'esquive</th>
                    <th>Date de validation</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($invites) && is_array($invites)): ?>
                <?php foreach ($invites as $invite): ?>
                <tr>
                    <td><strong><?= esc($invite['nom']) ?></strong></td>
                    <td><?= esc($invite['question']) ?></td>
                    <td><?= esc($invite['reponse']) ?></td>
                    <td class="tentatives"><?= esc($invite['tentatives_non']) ?> fois</td>
                    <td><?= date('d/m/Y - H:i', strtotime($invite['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Personne n'a encore réussi à cliquer sur "Oui"...</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>