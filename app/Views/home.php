<?php if (!auth()->loggedIn()) : ?>
<div>
    <p>
        <a href="<?= base_url('login') ?>">Connectez-vous</a> ou
        <a href="<?= base_url('register') ?>">créez un compte</a>
    </p>
</div>
<?php else : ?>
<div>
    <a href="<?= base_url('item/form') ?>">+ Ajouter une carte</a>
</div>
<?php endif; ?>

<?php if (empty($groupedItems)) : ?>
<div>
    <h3>Aucune carte à afficher pour le moment.</h3>
</div>
<?php else : ?>
<?php foreach ($groupedItems as $headerNom => $divisions): ?>
<h2>
    <?= esc($headerNom) ?>
</h2>

<?php foreach ($divisions as $divisionNom => $items): ?>
<h3>
    > <?= esc($divisionNom) ?>
</h3>

<div>

    <?php foreach ($items as $item): ?>
    <div>

        <h4>
            <?= esc($item['titre']) ?>
        </h4>

        <?php if (!empty($item['description'])): ?>
        <p>
            <?= nl2br(esc($item['description'])) ?>
        </p>
        <?php endif; ?>

        <?php if (!empty($item['saison']) || !empty($item['episode'])): ?>
        <div>
            <?php if (!empty($item['saison'])) echo "<strong>Saison :</strong> " . esc($item['saison']) . " &nbsp;|&nbsp; "; ?>
            <?php if (!empty($item['episode'])) echo "<strong>Épisode :</strong> " . esc($item['episode']); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['lien'])): ?>
        <div>
            <a href="<?= esc($item['lien']) ?>" target="_blank" rel="noopener noreferrer">Consulter le lien ↗</a>
        </div>
        <?php endif; ?>

        <?php if (auth()->loggedIn() && auth()->id() == $item['id_user']) : ?>
        <div>
            <a href="<?= base_url('item/form/' . $item['id']) ?>">
                ✏️ Modifier
            </a>
            <a href="<?= base_url('item/delete/' . $item['id']) ?>"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cette carte ?')">
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