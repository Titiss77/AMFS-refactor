<?php if (!auth()->loggedIn()): ?>
<div class="empty-state shadow-card">
    <h2>Bienvenue sur AMFS Dashboard</h2>
    <p>Veuillez vous connecter ou créer un compte pour gérer et visualiser vos cartes.</p>
    <br>
    <a href="<?= base_url('login') ?>" class="btn btn-primary">Se connecter</a>
</div>
<?php else: ?>
<div class="actions-container">
    <a href="<?= base_url('item/form') ?>" class="btn btn-success">+ Ajouter une carte</a>
</div>
<?php endif; ?>

<?php if (empty($groupedItems)): ?>
<?php if (auth()->loggedIn()): ?>
<div class="empty-state">
    <h2>Vous n'avez pas encore de cartes.</h2>
    <p>Commencez par en ajouter une !</p>
    <br>
    <a href="<?= base_url('item/form') ?>" class="btn btn-success">+ Ajouter une carte</a>
</div>
<?php else: ?>
<div class="empty-state">
    <p>Aucune donnée disponible.</p>
</div>
<?php endif; ?>

<?php else: ?>
<?php foreach ($groupedItems as $headerName => $divisions): ?>
<section class="header-section">
    <h2 class="header-title">
        <?= htmlspecialchars($headerName) ?>
    </h2>

    <?php foreach ($divisions as $divisionName => $items): ?>
    <div class="division-section">
        <h3 class="division-title">&#x25B6; <?= htmlspecialchars($divisionName) ?></h3>

        <div class="cards-grid">
            <?php foreach ($items as $item): ?>
            <div class="card">
                <div class="card-body">
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

                    <a href="<?= htmlspecialchars($lienFinal) ?>" target="_blank" class="card-link-block">
                        <h4 class="card-title"><?= htmlspecialchars($item['titre']) ?></h4>
                        <?php if (!empty($item['description'])): ?>
                        <p class="card-desc"><?= htmlspecialchars($item['description']) ?></p>
                        <?php endif; ?>
                    </a>

                    <div class="card-meta">
                        <?php if (isset($item['saison'])): ?>
                        <span class="meta-season">S: <?= htmlspecialchars($item['saison'] ?? '1') ?></span> <span
                            class="separator">|</span>
                        <?php endif; ?>

                        <?php if (isset($item['episode'])): ?>
                        <span class="meta-episode">Ep: <?= htmlspecialchars($item['episode'] ?? '1') ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (auth()->loggedIn()): ?>
                <div class="card-actions-bottom">
                    <a href="<?= base_url('item/form/' . $item['id']) ?>" class="btn-edit-sm">✏️ Modifier</a>
                    <a href="<?= base_url('item/delete/' . $item['id']) ?>"
                        onclick="return confirm('Es-tu sûr de vouloir supprimer cette carte ?');"
                        class="btn-delete-sm">🗑️ Supprimer</a>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<?php endforeach; ?>
<?php endif; ?>