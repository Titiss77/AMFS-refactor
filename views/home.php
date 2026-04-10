<?php 
// Sécurité : s'assurer qu'il y a des données à afficher
if (empty($groupedItems)) {
    echo "<p>Aucune donnée disponible.</p>";
} else {
    // Boucle sur les Headers (ex: Streaming, IA, Séries...)
    foreach ($groupedItems as $headerName => $divisions) : ?>

<section class="header-section" style="margin-bottom: 50px;">
    <h2 style="border-bottom: 2px solid var(--couleur-secondaire); padding-bottom: 10px;">
        <?= htmlspecialchars($headerName) ?>
    </h2>

    <?php 
            // Boucle sur les Divisions de ce Header (ex: Animés à voir, En cours...)
            foreach ($divisions as $divisionName => $items) : ?>

    <div class="division-section" style="margin-left: 20px; margin-bottom: 30px;">
        <h3 style="color: var(--texte-secondaire);">
            &#x25B6; <?= htmlspecialchars($divisionName) ?>
        </h3>

        <div class="cards-container"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">

            <?php 
                        // Boucle sur les cartes de cette division
                        foreach ($items as $item) : ?>

            <a href="<?= htmlspecialchars($item['lien'] ?? '#') ?>" target="_blank"
                style="text-decoration: none; color: inherit;">
                <div class="card"
                    style="background: var(--fond-carte); border: 1px solid var(--bordure); border-radius: 8px; overflow: hidden; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

                    <div class="card-body" style="padding: 15px;">
                        <h4 style="margin: 0 0 10px 0; font-size: 16px;"><?= htmlspecialchars($item['titre']) ?></h4>

                        <?php if (!empty($item['description'])): ?>
                        <p style="font-size: 12px; color: var(--texte-secondaire); margin-bottom: 8px;">
                            <?= htmlspecialchars($item['description']) ?>
                        </p>
                        <?php endif; ?>

                        <div style="font-size: 12px; font-weight: bold;">
                            <span style="color: var(--info);">Ep: <?= htmlspecialchars($item['episode']) ?></span>
                        </div>
                    </div>

                </div>
            </a>

            <?php endforeach; ?>
        </div>
    </div>

    <?php endforeach; ?>
</section>

<?php endforeach; 
} 
?>