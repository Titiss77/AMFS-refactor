<?php
// On inclut l'autoloader de Composer (assurez-vous que le chemin est correct)
require_once __DIR__ . '/vendor/autoload.php';

$error = null;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['convert'])) {
    // Vérifier s'il y a une erreur d'upload
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $tmpFilePath = $_FILES['pdf_file']['tmp_name'];

        // Initialiser le parseur PDF
        $parser = new \Smalot\PdfParser\Parser();

        try {
            // Extraire le texte du fichier PDF temporaire
            $pdf = $parser->parseFile($tmpFilePath);
            $text = $pdf->getText();

            $lines = explode("\n", $text);
            $csvData = [];

            // Ligne d'en-tête
            $csvData[] = ['Place', 'Nom/Prénom', 'Année', 'Catégorie', 'Club', 'Temps 1', 'Temps 2', 'Statut/Remarque'];

            foreach ($lines as $line) {
                // Nettoyage de base : on écrase les espaces multiples
                $line = trim(preg_replace('/\s+/u', ' ', $line));
                if (empty($line))
                    continue;

                // 1. Isoler le statut perturbateur
                $statut = '';
                if (preg_match('/\(en finale\)|Abandon|Disqualification|Forfait|Faux départ/i', $line, $matches)) {
                    $statut = trim($matches[0]);
                    $line = trim(str_replace($statut, '', $line));
                }

                // 2. Séparer manuellement les éléments collés à cause du PDF
                // Club et Temps : "*CPBR58.37" -> "*CPBR 58.37"
                $line = preg_replace('/([A-Z]{2,})([\d])/', '$1 $2', $line);

                // Temps intermédiaires : "58.372:02.07" -> "58.37 2:02.07"
                $line = preg_replace('/(\d{2}\.\d{2})([\d])/', '$1 $2', $line);

                // Records : "18.26MPF" -> "18.26 MPF"
                $line = preg_replace('/([\d])(MPF|RF|RM|RE|IN)/', '$1 $2', $line);

                // 3. LE SCANNER DE STRUCTURE (CORRIGÉ)
                // L'astuce est ici : on utilise \s* pour accepter les éléments complètement collés (ex: "Lola06FSE").
                // (\d*) permet aussi d'accepter les lignes sans classement (comme les abandons).
                $pattern = '/^(\d*)\s*([a-zA-ZÀ-ÿ\s\'-]+?)\s*(\d{2})\s*([FH][A-Z0-9+]{2,3})\s*(\*?\s*[a-zA-Z0-9]{2,})\s*(.*)$/ui';

                if (preg_match($pattern, $line, $m)) {
                    $place = $m[1];
                    $nom = trim($m[2]);
                    $annee = $m[3];
                    $categorie = trim($m[4]);
                    $club = trim($m[5]);

                    // 4. Gestion des temps
                    $temps_brut = trim(preg_replace('/\s+/', ' ', $m[6]));
                    $temps_array = explode(' ', $temps_brut);

                    $temps1 = isset($temps_array[0]) ? $temps_array[0] : '';
                    $temps2 = isset($temps_array[1]) ? $temps_array[1] : '';

                    // S'il y a un 3ème élément (ex: un record non capté), on l'ajoute au statut
                    if (isset($temps_array[2])) {
                        $statut = trim($statut . ' ' . $temps_array[2]);
                    }

                    // Nettoyage des mentions résiduelles sur les temps
                    if (preg_match('/([a-zA-Z]+)$/', $temps1, $rec)) {
                        $temps1 = str_replace($rec[1], '', $temps1);
                        $statut = trim($statut . ' ' . $rec[1]);
                    }
                    if (preg_match('/([a-zA-Z]+)$/', $temps2, $rec)) {
                        $temps2 = str_replace($rec[1], '', $temps2);
                        $statut = trim($statut . ' ' . $rec[1]);
                    }

                    // Ajout au CSV
                    $csvData[] = [$place, $nom, $annee, $categorie, $club, $temps1, $temps2, $statut];
                } else {
                    // Lignes qui ne sont pas des nageurs (Titre d'épreuve, entêtes...)
                    $csvData[] = [$line, '', '', '', '', '', '', ''];
                }
            }

            // ---------------------------------------------------------
            // Lancement du téléchargement
            // ---------------------------------------------------------
            $filename = 'resultat_' . date('Ymd_His') . '.csv';

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            $output = fopen('php://output', 'w');
            fputs($output, chr(0xEF) . chr(0xBB) . chr(0xBF));  // Support Excel UTF-8

            foreach ($csvData as $row) {
                fputcsv($output, $row, ';');
            }

            fclose($output);
            exit;
        } catch (Exception $e) {
            $error = 'Erreur lors de la lecture du PDF : ' . $e->getMessage();
        }
    } else {
        $error = 'Veuillez sélectionner un fichier PDF valide ou vérifier sa taille.';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir PDF en CSV</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 50px;
        display: flex;
        justify-content: center;
    }

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
    }

    h1 {
        font-size: 20px;
        color: #333;
        margin-top: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    button {
        background-color: #0056b3;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    button:hover {
        background-color: #004494;
    }

    .error {
        color: red;
        background: #fdd;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Uploader un PDF pour le convertir en CSV</h1>

        <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pdf_file">Sélectionnez votre fichier PDF :</label><br><br>
                <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>
            </div>

            <button type="submit" name="convert">Convertir et Télécharger</button>
        </form>
    </div>

</body>

</html>