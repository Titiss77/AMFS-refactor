<?php if (!auth()->loggedIn()) : ?>
<div class="banner banner-info">
    <p>
        Vous visualisez actuellement les cartes de démonstration. <br>
        <a href="<?= base_url('login') ?>">Connectez-vous</a> ou
        <a href="<?= base_url('register') ?>">créez un compte</a>
        pour ajouter et gérer vos propres cartes !
    </p>
</div>
<?php else : ?>
<div class="actions-container">
    <a href="<?= base_url('item/form') ?>" class="btn btn-success">+ Ajouter une carte</a>
</div>
<?php endif; ?>

<?php if (empty($groupedItems)) : ?>
<div class="empty-state">
    <h3>Aucune carte à afficher pour le moment.</h3>
</div>
<?php else : ?>
<?php foreach ($groupedItems as $headerNom => $divisions): ?>
<h2 class="header-title"><?= esc($headerNom) ?></h2>

<?php foreach ($divisions as $divisionNom => $items): ?>
<h3 class="division-title">> <?= esc($divisionNom) ?></h3>

<div class="cards-grid">
    <?php foreach ($items as $item): ?>
    <div class="card">
        <h4 class="card-title"><?= esc($item['titre']) ?></h4>

        <?php if (!empty($item['description'])): ?>
        <p class="card-desc"><?= nl2br(esc($item['description'])) ?></p>
        <?php endif; ?>

        <?php if (!empty($item['saison']) || !empty($item['episode'])): ?>
        <div class="card-meta">
            <?php if (!empty($item['saison'])) echo "<strong>Saison :</strong> " . esc($item['saison']) . " <span class='separator'>|</span> "; ?>
            <?php if (!empty($item['episode'])) echo "<strong>Épisode :</strong> " . esc($item['episode']); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($item['lien'])): ?>
        <div class="card-link">
            <a href="<?= esc($item['lien']) ?>" target="_blank" rel="noopener noreferrer">Consulter le lien ↗</a>
        </div>
        <?php endif; ?>

        <?php if (auth()->loggedIn() && auth()->id() == $item['id_user']) : ?>
        <div class="card-actions">
            <a href="<?= base_url('item/form/' . $item['id']) ?>" class="btn-edit">✏️ Modifier</a>
            <a href="<?= base_url('item/delete/' . $item['id']) ?>" class="btn-delete"
                onclick="return confirm('Êtes-vous sûr ?')">🗑️ Supprimer</a>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endif; ?>