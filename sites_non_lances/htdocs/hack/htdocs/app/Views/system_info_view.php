<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de diagnostic</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        max-width: 800px;
        margin: auto;
    }

    .card {
        background: #f4f4f9;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    h2 {
        color: #333;
        margin-top: 0;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    li strong {
        display: inline-block;
        width: 150px;
    }
    </style>
</head>

<body>

    <h1>Vos informations de connexion</h1>

    <div class="card">
        <h2>1. Vues par le serveur (PHP / HTTP)</h2>
        <ul>
            <li><strong>Adresse IP :</strong> <?= esc($ip_address) ?></li>
            <li><strong>Navigateur :</strong> <?= esc($browser) ?></li>
            <li><strong>Système (OS) :</strong> <?= esc($platform) ?></li>
            <li><strong>Langues acceptées :</strong> <?= esc($languages) ?></li>

            <li><strong>City :</strong> <em><?= esc($geo_city) ?></em></li>
            <li><strong>Country :</strong> <em><?= esc($geo_country) ?></em></li>
            <li><strong>ISP :</strong> <em><?= esc($geo_isp) ?></em></li>
        </ul>
    </div>

    <div class="card">
        <h2>2. Vues par le client (JavaScript)</h2>
        <ul id="js-data">
            <!-- Rempli dynamiquement par JS -->
        </ul>
    </div>

    <script>
    // Fonction exécutée au chargement de la page
    document.addEventListener("DOMContentLoaded", function() {
        // Collecte des données via l'API Web
        const clientData = {
            "Résolution d'écran": screen.width + " x " + screen.height,
            "Fenêtre visible": window.innerWidth + " x " + window.innerHeight,
            "Profondeur de couleur": screen.colorDepth + " bits",
            "Langue du navigateur": navigator.language,
            "Cœurs logiques CPU": navigator.hardwareConcurrency || "Non disponible",
            "Mémoire RAM (est.)": navigator.deviceMemory ? navigator.deviceMemory + " GB" :
                "Non disponible",
            "Fuseau horaire": Intl.DateTimeFormat().resolvedOptions().timeZone,
            "Cookies activés": navigator.cookieEnabled ? "Oui" : "Non"
        };

        // Ciblage de la liste HTML
        const listElement = document.getElementById('js-data');

        // Injection des données dans le HTML
        for (const [key, value] of Object.entries(clientData)) {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${key} :</strong> ${value}`;
            listElement.appendChild(li);
        }
    });

    const geoListElement = document.getElementById('js-data');

    if ("geolocation" in navigator) {
        // Demande la position (déclenche l'alerte de permission)
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // L'utilisateur a accepté
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                const precision = position.coords.accuracy; // en mètres

                const li = document.createElement('li');
                li.innerHTML =
                    `<strong>Coordonnées GPS :</strong> Latitude ${lat}, Longitude ${lon} (précis à ${precision}m)`;
                // Génère un lien Google Maps
                li.innerHTML +=
                    ` <a href="https://www.google.com/maps?q=${lat},${lon}" target="_blank">[Voir sur la carte]</a>`;
                geoListElement.appendChild(li);
            },
            function(error) {
                // L'utilisateur a refusé ou une erreur s'est produite
                const li = document.createElement('li');
                let motif = "";
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        motif = "L'utilisateur a refusé la demande de géolocalisation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        motif = "Les informations de localisation sont indisponibles.";
                        break;
                    case error.TIMEOUT:
                        motif = "La demande a expiré.";
                        break;
                }
                li.innerHTML = `<strong>Coordonnées GPS :</strong> <em>Échec (${motif})</em>`;
                geoListElement.appendChild(li);
            }
        );
    } else {
        // Le navigateur est trop ancien
        const li = document.createElement('li');
        li.innerHTML = `<strong>Coordonnées GPS :</strong> <em>API non supportée par ce navigateur</em>`;
        geoListElement.appendChild(li);
    }
    </script>

</body>

</html>