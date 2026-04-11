<div style="margin-bottom: 20px; text-align: right;">
    <a href="<?= base_url('item/form') ?>" style=" background-color: var(--succes); color: white; padding: 10px 20px; text-decoration: none;
        border-radius: 5px; font-weight: bold;">+
        Ajouter une carte</a>
</div>

<?php
if (empty($groupedItems)) {
    echo '<p>Aucune donnée disponible.</p>';
} else {
    foreach ($groupedItems as $headerName => $divisions) {
        ?>
<section class="header-section" style="margin-bottom: 50px;">
    <h2 style="border-bottom: 2px solid var(--couleur-secondaire); padding-bottom: 10px;">
        <?php echo htmlspecialchars($headerName); ?>
    </h2>

    <?php foreach ($divisions as $divisionName => $items) { ?>
    <div class="division-section" style="margin-left: 20px; margin-bottom: 30px;">
        <h3 style="color: var(--texte-secondaire);">&#x25B6; <?php echo htmlspecialchars($divisionName); ?></h3>

        <div class="cards-container"
            style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            <?php foreach ($items as $item) { ?>

            <div class="card"
                style="background: var(--fond-carte); border: 1px solid var(--bordure); border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div class="card-body" style="padding: 15px; flex-grow: 1;">
                    <?php
                    // Variables de base
                    $lienFinal = $item['lien'] ?? '#';
                $ep = $item['episode'] ?? '1';
                $saison = $item['saison'] ?? '1';

                // Création des versions avec zéros (01, 001, 0001)
                $ep2 = str_pad($ep, 2, '0', STR_PAD_LEFT);
                $ep3 = str_pad($ep, 3, '0', STR_PAD_LEFT);
                $ep4 = str_pad($ep, 4, '0', STR_PAD_LEFT);

                // On remplace tous les mots-clés s'ils sont présents dans le lien
                $lienFinal = str_replace(
                    ['{ep}', '{s}', '{ep2}', '{ep3}', '{ep4}'],
                    [$ep, $saison, $ep2, $ep3, $ep4],
                    $lienFinal
                );
                ?>
                    <a href="<?php echo htmlspecialchars($lienFinal); ?>" target="_blank"
                        style="text-decoration: none; color: inherit; display: block; margin-bottom: 10px;">
                        <h4 style="margin: 0 0 10px 0; font-size: 16px; color: var(--couleur-principale);">
                            <?php echo htmlspecialchars($item['titre']); ?></h4>
                        <?php if (!empty($item['description'])) { ?>
                        <p style="font-size: 12px; color: var(--texte-secondaire); margin-bottom: 8px;">
                            <?php echo htmlspecialchars($item['description']); ?></p>
                        <?php } ?>
                    </a>
                    <div style="font-size: 12px; font-weight: bold;">
                        <?php if (isset($item['saison'])) { ?>
                        <span style="color: var(--succes);">S:
                            <?php echo htmlspecialchars($item['saison'] ?? '1'); ?></span> |
                        <?php } ?>

                        <?php if (isset($item['episode'])) { ?>
                        <span style="color: var(--info);">Ep:
                            <?php echo htmlspecialchars($item['episode'] ?? '1'); ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div
                    style="padding: 10px; background: var(--ligne-survol); border-top: 1px solid var(--bordure); display: flex; justify-content: space-between;">
                    <a href="<?= base_url('item/form/' . $item['id']) ?>"
                        style="color: var(--couleur-principale); text-decoration: none; font-size: 13px;">✏️
                        Modifier</a>
                    <a href="<?= base_url('item/delete/' . $item['id']) ?>"
                        onclick="return confirm('Es-tu sûr de vouloir supprimer cette carte ?');"
                        style="color: red; text-decoration: none; font-size: 13px;">🗑️ Supprimer</a>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
    <?php } ?>
</section>
<?php
    }
}
?>