<?php if (!auth()->loggedIn()) : ?>
<div style="background-color: #e9ecef; padding: 15px; border-radius: 5px; text-align: center; margin-bottom: 30px;">
    <p style="margin: 0;">
        <a href="<?= base_url('login') ?>"
            style="color: #007bff; font-weight: bold; text-decoration: none;">Connectez-vous</a> ou
        <a href="<?= base_url('register') ?>" style="color: #007bff; font-weight: bold; text-decoration: none;">créez un
            compte</a>
        pour ajouter et gérer vos propres cartes !
    </p>
</div>
<?php else : ?>
<div style="text-align: right; margin-bottom: 20px;">
    <a href="<?= base_url('item/form') ?>"
        style="padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
        + Ajouter une carte
    </a>
</div>
<?php endif; ?>

<?php if (empty($groupedItems)) : ?>
<div
    style="text-align: center; padding: 50px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3 style="color: #555;">Aucune carte à afficher pour le moment.</h3>
</div>
<?php else : ?>
<?php foreach ($groupedItems as $headerNom => $divisions): ?>
<h2 style="color: #333; border-bottom: 2px solid #ccc; padding-bottom: 5px; margin-top: 40px;">
    <?= esc($headerNom) ?>
</h2>

<?php foreach ($divisions as $divisionNom => $items): ?>
<h3 style="color: #666; margin-left: 10px; margin-top: 20px;">
    > <?= esc($divisionNom) ?>
</h3>

<div style="display: flex; flex-wrap: wrap; gap: 20px; margin-left: 10px; margin-bottom: 30px;">

    <?php foreach ($items as $item): ?>
    <div
        style="border: 1px solid #e0e0e0; padding: 15px; border-radius: 8px; width: 300px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">

        <h4 style="margin-top: 0; margin-bottom: 10px; color: #222;">
            <?= esc($item['titre']) ?>
        </h4>

        <?php if (!empty($item['description'])): ?>
        <p style="font-size: 0.9em; color: #555; line-height: 1.4;">
            <?= nl2br(esc($item['description'])) ?>
        </p>
        <?php endif; ?>

        <?php if (!empty($item['saison']) || !empty($item['episode'])): ?>
        <div
            style="font-size: 0.85em; background: #f8f9fa; padding: 8px; border-radius: 4px; margin-bottom: 10px; color: #444;">
            <?php if (!empty($item['saison'])) echo "<strong>Saison :</strong> " . esc($item['saison']) . " &nbsp;|&nbsp; "; ?>
            <?php if (!empty($item['episode'])) echo "<strong>Épisode :</strong> " . esc($item['episode']); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['lien'])): ?>
        <div style="margin-bottom: 10px;">
            <a href="<?= esc($item['lien']) ?>" target="_blank" rel="noopener noreferrer"
                style="color: #007bff; text-decoration: none; font-size: 0.9em; font-weight: bold;">
                Consulter le lien ↗
            </a>
        </div>
        <?php endif; ?>

        <?php if (auth()->loggedIn() && auth()->id() == $item['id_user']) : ?>
        <div
            style="margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee; text-align: right; font-size: 0.9em;">
            <a href="<?= base_url('item/form/' . $item['id']) ?>"
                style="color: #ffc107; text-decoration: none; margin-right: 15px; font-weight: bold;">
                ✏️ Modifier
            </a>
            <a href="<?= base_url('item/delete/' . $item['id']) ?>"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cette carte ?')"
                style="color: #dc3545; text-decoration: none; font-weight: bold;">
                🗑️ Supprimer
            </a>
        </div>
        <?php endif; ?>

    </div>
    <?php endforeach; ?>

</div>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endif; ?>