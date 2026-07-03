<!-- View/system_view.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic MVC Natif</title>
    <style>
    body {
        font-family: sans-serif;
        background: #f9f9f9;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .section {
        margin-bottom: 30px;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    strong {
        display: inline-block;
        width: 180px;
        color: #333;
    }

    .alert {
        background: #fff3cd;
        color: #856404;
        padding: 10px;
        border-radius: 4px;
        font-size: 0.9em;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Informations de connexion</h1>

        <div class="section">
            <h2>1. Côté Serveur (PHP)</h2>
            <ul>
                <li><strong>Adresse IP :</strong> <?= htmlspecialchars($ip_address) ?></li>
                <li><strong>Ville (via IP) :</strong> <?= htmlspecialchars($geo_city) ?></li>
                <li><strong>Pays (via IP) :</strong> <?= htmlspecialchars($geo_country) ?></li>
                <li><strong>FAI :</strong> <?= htmlspecialchars($geo_isp) ?></li>
                <li><strong>Navigateur brut :</strong> <?= htmlspecialchars($user_agent) ?></li>
                <li><strong>Langues acceptées :</strong> <?= htmlspecialchars($languages) ?></li>
            </ul>
        </div>

        <div class="section">
            <h2>2. Côté Client (JavaScript)</h2>
            <div class="alert">Une demande d'autorisation va s'afficher pour la localisation GPS exacte.</div>
            <ul id="js-data">
                <!-- Les données JS viendront s'insérer ici -->
            </ul>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const listElement = document.getElementById('js-data');

        // 1. Collecte des données matérielles et logicielles basiques
        const clientData = {
            "Résolution d'écran": screen.width + " x " + screen.height,
            "Fenêtre visible": window.innerWidth + " x " + window.innerHeight,
            "Langue de l'interface": navigator.language,
            "Cœurs processeur (logiques)": navigator.hardwareConcurrency || "Inconnu",
            "Mémoire vive (est.)": navigator.deviceMemory ? navigator.deviceMemory + " Go" : "Inconnue",
            "Fuseau horaire": Intl.DateTimeFormat().resolvedOptions().timeZone
        };

        // Injection dans le HTML
        for (const [key, value] of Object.entries(clientData)) {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${key} :</strong> ${value}`;
            listElement.appendChild(li);
        }

        // 2. Demande de géolocalisation HTML5 (Triangulation fine)
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const li = document.createElement('li');
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    const acc = position.coords.accuracy;
                    li.innerHTML = `<strong>Coordonnées GPS :</strong> Lat ${lat}, Lon ${lon} (Précision : ${acc} mètres) 
                                <a href="https://www.google.com/maps?q=${lat},${lon}" target="_blank">[Carte]</a>`;
                    listElement.appendChild(li);
                },
                (error) => {
                    const li = document.createElement('li');
                    li.innerHTML =
                        `<strong>Coordonnées GPS :</strong> <em>Refusé ou indisponible (Code ${error.code})</em>`;
                    listElement.appendChild(li);
                }
            );
        }
    });
    </script>

</body>

</html>