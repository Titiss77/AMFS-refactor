<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitAnalytics - Progression</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #4F46E5;
        --primary-hover: #4338CA;
        --bg: #F3F4F6;
        --card-bg: #FFFFFF;
        --text-main: #111827;
        --text-muted: #6B7280;
        --border: #E5E7EB;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg);
        color: var(--text-main);
        padding: 2rem 1rem;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    h1 {
        text-align: center;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 2rem;
        font-size: 2rem;
    }

    .card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
        border: 1px solid var(--border);
    }

    /* --- NOUVEAU : Styles pour la barre de recherche --- */
    .search-container {
        position: relative;
        max-width: 500px;
        margin: 0 auto 2rem auto;
    }

    .search-input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 2.5rem;
        font-size: 1rem;
        font-family: 'Inter', sans-serif;
        color: var(--text-main);
        background-color: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        pointer-events: none;
    }

    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        margin-top: 0.25rem;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        max-height: 250px;
        overflow-y: auto;
        z-index: 50;
        display: none;
        list-style: none;
    }

    .dropdown-item {
        padding: 0.75rem 1rem;
        cursor: pointer;
        transition: background-color 0.15s ease;
        color: var(--text-main);
    }

    .dropdown-item:hover {
        background-color: #F3F4F6;
        color: var(--primary);
    }

    /* --------------------------------------------------- */

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    th {
        background-color: #F9FAFB;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem;
        text-align: left;
        border-bottom: 2px solid var(--border);
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
        font-size: 0.875rem;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover {
        background-color: #F9FAFB;
    }

    .details-text {
        color: var(--text-muted);
        font-family: monospace;
        background: #F3F4F6;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Analyse de Progression</h1>

        <!-- --- NOUVEAU : Barre de recherche avec liste déroulante custom --- -->
        <div class="search-container">
            <span class="search-icon">🔍</span>
            <input type="text" id="exoSearch" class="search-input" placeholder="Taper pour chercher un exercice..."
                autocomplete="off">
            <ul id="exoDropdown" class="dropdown-list"></ul>
        </div>

        <div class="card" id="chartCard" style="display: none;">
            <canvas id="progressionChart"></canvas>
        </div>

        <div id="tableContainer" class="card" style="display: none;"></div>
    </div>

    <script>
    let fullHistory = {};
    let myChart;

    // Fonction utilitaire pour formater YYYYMMDD en DD/MM/YYYY
    function formatReadableDate(dateStr) {
        if (dateStr && dateStr.length === 8) {
            const year = dateStr.substring(0, 4);
            const month = dateStr.substring(4, 6);
            const day = dateStr.substring(6, 8);
            return `${day}/${month}/${year}`;
        }
        return dateStr;
    }

    fetch('historique_complet.json')
        .then(res => res.json())
        .then(data => {
            fullHistory = data;
            const dropdown = document.getElementById('exoDropdown');
            const exercicesTries = Object.keys(data).sort((a, b) => a.localeCompare(b));

            // Génération de la liste HTML pour l'auto-complétion
            exercicesTries.forEach(exo => {
                const li = document.createElement('li');
                li.className = 'dropdown-item';
                li.textContent = exo;

                // Action au clic sur un élément de la liste
                li.addEventListener('click', () => {
                    document.getElementById('exoSearch').value = exo;
                    dropdown.style.display = 'none';
                    updateChart(exo);
                });

                dropdown.appendChild(li);
            });
        })
        .catch(err => console.error("Erreur de chargement des données :", err));

    // --- LOGIQUE DE RECHERCHE ET D'AFFICHAGE DU DROPDOWN ---
    const searchInput = document.getElementById('exoSearch');
    const dropdownMenu = document.getElementById('exoDropdown');

    // Filtrer la liste à chaque frappe clavier
    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const items = dropdownMenu.getElementsByTagName('li');
        let hasVisible = false;

        for (let i = 0; i < items.length; i++) {
            const txtValue = items[i].textContent.toLowerCase();
            if (txtValue.indexOf(filter) > -1) {
                items[i].style.display = "";
                hasVisible = true;
            } else {
                items[i].style.display = "none";
            }
        }
        dropdownMenu.style.display = hasVisible ? 'block' : 'none';
    });

    // Afficher toute la liste au focus sur le champ vide
    searchInput.addEventListener('focus', function() {
        dropdownMenu.style.display = 'block';
        this.dispatchEvent(new Event('input')); // Force le rafraîchissement du filtre
    });

    // Fermer le dropdown en cliquant à l'extérieur
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.search-container')) {
            dropdownMenu.style.display = 'none';
        }
    });
    // -------------------------------------------------------

    function updateChart(exoKey) {
        const chartCard = document.getElementById('chartCard');
        const tableContainer = document.getElementById('tableContainer');

        // Sécurité : vérifier que l'exercice existe bien dans l'historique
        if (!exoKey || !fullHistory[exoKey]) {
            chartCard.style.display = 'none';
            tableContainer.style.display = 'none';
            return;
        }

        chartCard.style.display = 'block';
        tableContainer.style.display = 'block';

        const dataPoints = fullHistory[exoKey].sort((a, b) => a.date.localeCompare(b.date));
        const labels = dataPoints.map(p => formatReadableDate(p.date));

        const ctx = document.getElementById('progressionChart').getContext('2d');
        if (myChart) myChart.destroy();

        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#6B7280';

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Volume Total (kg)',
                        data: dataPoints.map(p => p.volume),
                        borderColor: '#4F46E5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Répétitions Totales',
                        data: dataPoints.map(p => p.total_reps),
                        borderColor: '#F59E0B',
                        borderWidth: 2,
                        tension: 0.3,
                        borderDash: [5, 5],
                        yAxisID: 'y1'
                    },
                    {
                        label: 'Poids Moyen (kg)',
                        data: dataPoints.map(p => p.poids),
                        borderColor: '#10B981',
                        borderWidth: 2,
                        tension: 0.3,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.9)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodySpacing: 6
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Volume (kg)'
                        },
                        border: {
                            display: false
                        }
                    },
                    y1: {
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Reps / Poids'
                        },
                        grid: {
                            drawOnChartArea: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        let tableHtml = `
        <h3 style="margin-bottom: 1rem; font-weight: 500; color: #111827;">Historique : <span style="color: var(--primary);">${exoKey}</span></h3>
        <div class="table-responsive">
            <table>                     
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Séries</th>
                        <th>Reps Totales</th>
                        <th>Poids Moyen</th>
                        <th>Volume</th>
                        <th>Détails des séries</th>
                    </tr>
                </thead>
                <tbody>`;

        dataPoints.forEach(p => {
            let detailsText = p.details ?
                p.details.map(d => `${d.reps}x${d.poids}`).join(' | ') :
                "N/A";

            tableHtml += `
                    <tr>
                        <td><strong>${formatReadableDate(p.date)}</strong></td>
                        <td>${p.series}</td>
                        <td>${p.total_reps}</td>
                        <td>${p.poids} kg</td>
                        <td style="color: var(--primary); font-weight: 600;">${p.volume}</td>
                        <td><span class="details-text">${detailsText}</span></td>
                    </tr>`;
        });

        tableHtml += `
                </tbody>
            </table>
        </div>`;

        document.getElementById('tableContainer').innerHTML = tableHtml;
    }
    </script>
</body>

</html>