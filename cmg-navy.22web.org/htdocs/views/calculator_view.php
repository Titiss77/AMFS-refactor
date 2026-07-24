<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculateur de Masse Grasse & Métabolisme</title>
    <link rel="stylesheet" href="public/style.css">
    <style>
    /* Styles spécifiques à l'historique et au bouton de sauvegarde */
    .save-section {
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px dashed var(--border);
        text-align: center;
    }

    .save-section p {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .info-section {
        margin-top: 2.5rem;
        border-top: 1px dashed red;
        text-align: center;
    }

    .info-section p {
        font-size: 0.85rem;
        color: red;
        margin-bottom: -2rem;
    }

    .btn-save {
        width: 100%;
        padding: 1rem;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background 0.3s, transform 0.1s;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }

    .btn-save:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
    }

    .history-container {
        margin-top: 3rem;
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .history-table th,
    .history-table td {
        border-bottom: 1px solid var(--border);
        padding: 10px 8px;
        text-align: center;
    }

    .history-table th {
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
    }
    </style>
</head>

<body>
    <div class="user-bar">
        <span>Connecté en tant que
            <strong><?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></strong></span>
        <a href="index.php?action=logout">Se déconnecter</a>
    </div>
    <div class="widget-container">
        <h2>Calculateur US Navy & Énergie</h2>

        <form method="POST" action="index.php?action=save">
            <!-- Zone des inputs -->
            <!-- Zone des inputs (Modifiés pour accepter la virgule) -->
            <div class="form-group">
                <label for="gender">Genre</label>
                <select id="gender" name="gender">
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                </select>
            </div>

            <!-- Définition des dernières valeurs enregistrées (ou valeurs par défaut si vide) -->
            <?php
            $last_height = !empty($history) ? $history[0]['height'] : '170';
            $last_weight = !empty($history) ? $history[0]['weight'] : '75';
            $last_neck = !empty($history) ? $history[0]['neck'] : '37';
            $last_waist = !empty($history) ? $history[0]['waist'] : '79';
            $last_hip = (!empty($history) && $history[0]['hip'] !== null) ? $history[0]['hip'] : '95';
            ?>

            <!-- Zone des inputs -->
            <div class="form-group">
                <label for="height">Taille (cm)</label>
                <input type="text" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?" id="height" name="height"
                    value="<?= $last_height ?>">
            </div>

            <div class="form-group">
                <label for="weight">Poids (kg)</label>
                <input type="text" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?" id="weight" name="weight"
                    value="<?= $last_weight ?>">
            </div>

            <div class="form-group">
                <label for="neck">Tour de cou (cm)</label>
                <input type="text" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?" id="neck" name="neck"
                    value="<?= $last_neck ?>">
            </div>

            <div class="form-group">
                <label for="waist">Tour de taille (cm) - Au niveau du nombril</label>
                <input type="text" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?" id="waist" name="waist"
                    value="<?= $last_waist ?>">
            </div>

            <div class="form-group hidden" id="hip-group">
                <label for="hip">Tour de hanches (cm) - Point le plus large</label>
                <input type="text" inputmode="decimal" pattern="[0-9]+([.,][0-9]+)?" id="hip" name="hip"
                    value="<?= $last_hip ?>">
            </div>

            <div class="form-group">
                <label for="activity">Niveau d'activité hebdomadaire (NEAT & Sport)</label>
                <select id="activity" name="activity">
                    <option value="1.2">Sédentaire (Travail de bureau, pas de sport)</option>
                    <option value="1.375">Légèrement actif (Sport léger 1 à 3 fois/semaine)</option>
                    <option value="1.55" selected>Modérément actif (Sport modéré 3 à 5 fois/semaine)</option>
                    <option value="1.725">Très actif (Entraînement intense 6 à 7 jours/semaine)</option>
                    <option value="1.9">Extrêmement actif (Biquotidien)</option>
                </select>
            </div>

            <!-- Première échelle : Pourcentage de graisse -->
            <div class="chart-container">
                <div class="zones">
                    <div class="zone" id="zone-bas" style="background-color: #d1d5db;">Bas</div>
                    <div class="zone" id="zone-ess" style="background-color: #b4c6e7;">Essentielle</div>
                    <div class="zone" id="zone-ath" style="background-color: #b5d3ba;">Athlètes</div>
                    <div class="zone" id="zone-fit" style="background-color: #eff6ff;">Fitness</div>
                    <div class="zone" id="zone-moy" style="background-color: #ffe699;">Moyen</div>
                    <div class="zone" id="zone-obe" style="background-color: #e6b8b7;">Obèse</div>
                </div>
                <div class="axis">
                    <span>0</span><span>5</span><span>10</span><span>15</span>
                    <span>20</span><span>25</span><span>30</span><span>35</span>
                    <span>40</span><span>45</span>
                </div>
                <div class="axis-label">Pourcentage de graisse (%) &rarr;</div>
                <div class="indicator" id="indicator">
                    <div class="indicator-value" id="indicator-value">--%</div>
                    <div class="indicator-line"></div>
                </div>
            </div>


            <div class="summary-container">
                <div class="summary-box">
                    <div class="summary-label">GRAISSE CORPORELLE</div>
                    <div class="summary-value-text" id="summary-bf">--%</div>
                </div>
                <div class="summary-divider"></div>
                <div class="summary-box">
                    <div class="summary-label">CATÉGORIE</div>
                    <div class="summary-cat-text" id="summary-cat">--</div>
                </div>
            </div>

            <!-- NOUVELLE ÉCHELLE : IMC -->
            <div class="info-section">
                <p>L'IMC est un indicateur purement statistique et indicatif ; il ne constitue en rien un facteur ou une
                    mesure fiable de l'état de santé.</p>
            </div>
            <div class="chart-container" style="margin-top: 3.5rem;">
                <div class="zones">
                    <div class="zone" style="background-color: #b4c6e7; width: 37.03%;">Maigreur</div>
                    <!-- IMC < 18.5 -->
                    <div class="zone" style="background-color: #b5d3ba; width: 22.22%;">Normal</div> <!-- 18.5 - 25 -->
                    <div class="zone" style="background-color: #ffe699; width: 18.52%;">Surpoids</div> <!-- 25 - 30 -->
                    <div class="zone" style="background-color: #e6b8b7; width: 22.22%;">Obésité</div> <!-- 30 - 40+ -->
                </div>
                <div class="axis">
                    <span>0</span><span>5</span><span>10</span><span>15</span>
                    <span>18.5</span><span>25</span><span>30</span><span>35</span><span>40</span>
                </div>
                <div class="axis-label">Indice de Masse Corporelle (IMC) &rarr;</div>
                <div class="indicator" id="imc-indicator">
                    <div class="indicator-value" id="imc-indicator-value">--</div>
                    <div class="indicator-line"></div>
                </div>
            </div>

            <div class="details-container">
                <div class="detail-box">
                    <div class="detail-label">MASSE GRASSE</div>
                    <div class="detail-value" id="detail-fat">-- kg</div>
                    <div class="detail-sub">Tissu adipeux</div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">MASSE MAIGRE</div>
                    <div class="detail-value" id="detail-lean">-- kg</div>
                    <div class="detail-sub">Muscles, eau, os</div>
                </div>
            </div>

            <div class="energy-container">
                <div class="energy-box">
                    <div class="energy-label">MÉTABOLISME DE BASE (BMR)</div>
                    <div class="energy-value" id="energy-bmr">-- kcal</div>
                    <div class="energy-sub">Calories brûlées au repos absolu</div>
                </div>
                <div class="energy-box highlight-box">
                    <div class="energy-label">MAINTIEN CALORIQUE (TDEE)</div>
                    <div class="energy-value highlight-text" id="energy-tdee">-- kcal</div>
                    <div class="energy-sub">Objectif journalier pour maintenir le poids</div>
                </div>
            </div>


            <div class="save-section">
                <p>Les résultats s'affichent en direct au-dessus. Cliquez ici uniquement pour sauvegarder officiellement
                    ce relevé.</p>
                <button type="submit" class="btn-primary">Enregistrer le relevé officiel</button>
            </div>
        </form>
    </div>

    <!-- Affichage de l'historique PHP (Optionnel, en bas) -->
    <?php if (!empty($history)): ?>
    <div class="widget-container history-container" style="max-width: 650px; margin-top: 2rem;">
        <h3 style="margin-top: 0; text-align: center; color: var(--text-main);">Historique des Mesures</h3>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Poids</th>
                    <th>MG (%)</th>
                    <th>Masse Maigre</th>
                    <th>TDEE</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $row): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td><?= $row['weight'] ?> kg</td>
                    <td style="color: var(--primary); font-weight: bold;"><?= $row['body_fat'] ?>%</td>
                    <td><?= $row['lean_mass'] ?> kg</td>
                    <td><?= $row['tdee'] ?> kcal</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Graphique Chart.js -->
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed var(--border);">
            <canvas id="historyChart"></canvas>
        </div>

        <!-- NOUVEAU : Badges de Progression (Deltas) -->
        <?php
        if (count($history) >= 2):
            $current = $history[0];  // La mesure la plus récente
            $previous = $history[1];  // La mesure précédente
            $first = end($history);  // La toute première mesure enregistrée (la dernière du tableau)

            // Calculs des deltas
            $deltaWeight = $current['weight'] - $first['weight'];  // Depuis le TOUT DÉBUT
            $deltaBF = $current['body_fat'] - $previous['body_fat'];  // Depuis la dernière fois
            $deltaLean = $current['lean_mass'] - $previous['lean_mass'];  // Depuis la dernière fois

            // Fonction pour formater les deltas avec les bonnes couleurs
            function formatDelta($val, $unit, $invertColors = false)
            {
                if ($val == 0)
                    return "<span style='color: #64748b; font-weight: bold;'>= 0 $unit</span>";

                $sign = $val > 0 ? '+' : '';
                $color = '#64748b';  // Gris par défaut

                if ($val > 0)
                    $color = $invertColors ? '#ef4444' : '#22c55e';  // Rouge si inversé (gras), Vert sinon (muscle)
                if ($val < 0)
                    $color = $invertColors ? '#22c55e' : '#ef4444';  // Vert si inversé (perte de gras), Rouge sinon (perte de muscle)

                return "<span style='color: $color; font-weight: bold;'>" . $sign . number_format($val, 2, ',', ' ') . " $unit</span>";
            }
            ?>
        <div class="badges-container">
            <div class="badge">
                <div class="badge-title">Poids Total</div>
                <div class="badge-value"><?= formatDelta($deltaWeight, 'kg') ?></div>
                <div class="badge-context">Depuis la 1ère pesée</div>
            </div>
            <div class="badge">
                <div class="badge-title">Masse Grasse</div>
                <div class="badge-value"><?= formatDelta($deltaBF, '%', true) ?></div>
                <!-- True pour inverser les couleurs (baisse = vert) -->
                <div class="badge-context">Tissu adipeux</div>
            </div>
            <div class="badge">
                <div class="badge-title">Masse Maigre</div>
                <div class="badge-value"><?= formatDelta($deltaLean, 'kg') ?></div>
                <div class="badge-context">Gain musculaire / Eau</div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Chargement de la librairie Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const historyData = <?= json_encode(array_reverse($history)) ?>;

    if (historyData.length > 0) {
        const labels = historyData.map(row => {
            const d = new Date(row.created_at);
            return d.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: '2-digit'
            });
        });
        const weights = historyData.map(row => row.weight);
        const leanMasses = historyData.map(row => row.lean_mass);
        const bodyFats = historyData.map(row => row.body_fat);

        const ctx = document.getElementById('historyChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Poids Total (kg)',
                        data: weights,
                        borderColor: '#64748b',
                        backgroundColor: 'rgba(100, 116, 139, 0.1)',
                        yAxisID: 'y',
                        tension: 0.4,
                        borderWidth: 2
                    },
                    {
                        label: 'Masse Maigre (kg)',
                        data: leanMasses,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.2)',
                        yAxisID: 'y',
                        tension: 0.4,
                        borderWidth: 3,
                        fill: true
                    },
                    {
                        label: 'Masse Grasse (%)',
                        data: bodyFats,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        yAxisID: 'y1',
                        tension: 0.4,
                        borderDash: [5, 5],
                        borderWidth: 2
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
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Kilogrammes (kg)'
                        },
                        suggestedMin: Math.min(...leanMasses) - 2,
                        suggestedMax: Math.max(...weights) + 2
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Pourcentage MG (%)'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });
    }
    </script>
    <?php endif; ?>

    <script src="public/script.js"></script>
</body>

</html>