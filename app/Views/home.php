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
    <details class="division-section">
        <summary class="division-title">
            <span class="toggle-icon">&#x25B6;</span> <?= htmlspecialchars($divisionName) ?>
        </summary>

        <div class="cards-grid">
            <?php foreach ($items as $item): ?>
            <div class="card fade-in">
                <div class="card-body">
                    <?php
                    $lienFinal = $item['lien'] ?? '#';
                    $ep = $item['episode'] ?? '1';
                    $saison = $item['saison'] ?? '1';

                    $ep2 = str_pad((string) $ep, 2, '0', STR_PAD_LEFT);
                    $ep3 = str_pad((string) $ep, 3, '0', STR_PAD_LEFT);
                    $ep4 = str_pad((string) $ep, 4, '0', STR_PAD_LEFT);

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

                    <div class="card-badges">
                        <?php if (!empty($item['saison'])): ?>
                        <span class="badge badge-season">Saison <?= htmlspecialchars($item['saison']) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($item['episode'])): ?>
                        <span class="badge badge-episode">Ép. <?= htmlspecialchars($item['episode']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (auth()->loggedIn() && (int) $item['id_user'] === (int) auth()->id()): ?>
                <div class="card-actions-bottom">
                    <a href="<?= base_url('item/form/' . $item['id']) ?>" class="btn-icon btn-edit-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Modifier
                    </a>
                    <a href="<?= base_url('item/delete/' . $item['id']) ?>"
                        onclick="return confirm('Es-tu sûr de vouloir supprimer cette carte ?');"
                        class="btn-icon btn-delete-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Supprimer
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </details>
    <?php endforeach; ?>
</section>
<?php endforeach; ?>
<?php endif; ?>