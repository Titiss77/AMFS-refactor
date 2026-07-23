<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>FitAnalytics - Progression ptit test</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    :root {
        --primary: #36a2eb;
        --bg: #f4f7f6;
        --card: #ffffff;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: var(--bg);
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #2c3e50;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .selector-box {
        text-align: center;
        margin-bottom: 20px;
    }

    select {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ddd;
        cursor: pointer;
    }

    .card {
        background: var(--card);
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th {
        background-color: var(--primary);
        color: white;
        padding: 12px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    tr:hover {
        background-color: #f1f9ff;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Progression par Exercice</h1>
        <div class="selector-box">
            <select id="exoSelector" onchange="updateChart()">
                <option value="">Choisir un exercice...</option>
            </select>
        </div>
        <div class="card">
            <canvas id="progressionChart"></canvas>
        </div>
        <div id="tableContainer" class="card"></div>
    </div>
    <script>
    let fullHistory = {};
    let myChart;
    fetch('historique_complet.json')
        .then(res => res.json())
        .then(data => {
            fullHistory = data;
            const selector = document.getElementById('exoSelector');

            // 1. On extrait toutes les clés (noms des exos)
            // 2. On les trie proprement par ordre alphabétique
            const exercicesTries = Object.keys(data).sort((a, b) => a.localeCompare(b));

            // 3. On génère les options du menu avec la liste triée
            exercicesTries.forEach(exo => {
                selector.innerHTML += `<option value="${exo}">${exo}</option>`;
            });
        });

    function updateChart() {
        const exo = document.getElementById('exoSelector').value;
        if (!exo) return;
        const dataPoints = fullHistory[exo].sort((a, b) => a.date.localeCompare(b.date));
        const ctx = document.getElementById('progressionChart').getContext('2d');
        if (myChart) myChart.destroy();
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataPoints.map(p => p.date),
                datasets: [{
                        label: 'Volume (kg)',
                        data: dataPoints.map(p => p.volume),
                        borderColor: '#36a2eb',
                        yAxisID: 'y'
                    },
                    {
                        label: 'Reps',
                        data: dataPoints.map(p => p.total_reps),
                        borderColor: '#ff6384',
                        yAxisID: 'y1'
                    },
                    {
                        label: 'Poids (kg)',
                        data: dataPoints.map(p => p.poids),
                        borderColor: '#4bc0c0',
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
                scales: {
                    y: {
                        position: 'left'
                    },
                    y1: {
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });

        let tableHtml = `<h3>Séances : ${exo}</h3>                 
        <table>                     
            <tr>
                <th>Date</th>
                <th>Séries</th>
                <th>Reps Totales</th>
                <th>Poids Moyen</th>
                <th>Volume</th>
                <th>Détails (Reps x Poids)</th>
            </tr>`;

        dataPoints.forEach(p => {
            // Création du texte détaillé (ex: 12x18kg | 10x18kg)
            let detailsText = p.details ? p.details.map(d => `${d.reps}x${d.poids}kg`).join(' | ') : "N/A";

            tableHtml +=
                `<tr>
                    <td>${p.date}</td>
                    <td>${p.series}</td>
                    <td>${p.total_reps}</td>
                    <td>${p.poids} kg</td>
                    <td>${p.volume}</td>
                    <td style="font-size: 0.9em; color: #555;">${detailsText}</td>
                </tr>`;
        });
        tableHtml += `</table>`;
        document.getElementById('tableContainer').innerHTML = tableHtml;
    }
    </script>
</body>

</html>