<?php if (!auth()->loggedIn()) { ?>
<div class="empty-state shadow-card">
    <h2>Bienvenue sur AMFS Dashboard</h2>
    <p style="color: var(--danger);">Seuls les Liens & Outils sont accessibles sans être connecté.</p>
    <p>Veuillez vous connecter ou créer un compte pour gérer et visualiser vos propres cartes.</p>
    <br>
    <a href=" <?php echo base_url('login'); ?>" class="btn btn-primary">Se connecter</a>
    <a href="<?php echo base_url('register'); ?>" class="btn btn-primary">Créer un compte</a>
</div>
<?php } else { ?>
<div class="actions-container">
    <a href="<?php echo base_url('item/form'); ?>" class="btn btn-success">+ Ajouter une carte</a>
</div>
<?php } ?>

<?php if (empty($groupedItems)) { ?>
<?php if (auth()->loggedIn()) { ?>
<div class="empty-state">
    <h2>Vous n'avez pas encore de cartes.</h2>
    <p>Commencez par en ajouter une !</p>
    <br>
    <a href="<?php echo base_url('item/form'); ?>" class="btn btn-success">+ Ajouter une carte</a>
</div>
<?php } else { ?>
<div class="empty-state">
    <p>Aucune donnée disponible.</p>
</div>
<?php } ?>

<?php } else { ?>
<?php foreach ($groupedItems as $headerName => $divisions) { ?>
<section class="header-section">
    <h2 class="header-title">
        <?php echo htmlspecialchars($headerName); ?>
    </h2>

    <?php foreach ($divisions as $divisionName => $items) { ?>
    <details class="division-section">
        <summary class="division-title">
            <span class="toggle-icon">&#x25B6;</span> <?php echo htmlspecialchars($divisionName); ?>
        </summary>

        <div class="cards-grid">
            <?php foreach ($items as $item) { ?>
            <div class="card fade-in">
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

                <a href="<?php echo htmlspecialchars($lienFinal); ?>" target="_blank" class="card-link-block">
                    <div class="card-body">

                        <h4 class="card-title"><?php echo htmlspecialchars($item['titre']); ?></h4>

                        <?php if (!empty($item['description'])) { ?>
                        <p class="card-desc"><?php echo htmlspecialchars($item['description']); ?></p>
                        <?php } ?>

                        <div class="card-badges">
                            <?php if (!empty($item['saison'])) { ?>
                            <span class="badge badge-season">Saison
                                <?php echo htmlspecialchars($item['saison']); ?></span>
                            <?php } ?>

                            <?php if (!empty($item['episode'])) { ?>
                            <span class="badge badge-episode">
                                Ép. <span
                                    id="ep-count-<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['episode']); ?></span>

                                <?php // Le bouton n'apparait que si c'est notre carte ?>
                                <?php if (auth()->loggedIn() && (int) $item['id_user'] === (int) auth()->id()) { ?>
                                <button type="button" class="btn-increment" data-id="<?php echo $item['id']; ?>"
                                    title="+1 Épisode">
                                    +1
                                </button>
                                <?php } ?>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-image">
                        <?php if (!empty($item['image'])) { ?>
                        <img src="<?php echo htmlspecialchars($item['image']); ?>"
                            alt="<?php echo htmlspecialchars($item['titre']); ?>" class="image-view">
                        <?php } ?>
                    </div>
                </a>

                <?php if (auth()->loggedIn() && (int) $item['id_user'] === (int) auth()->id()) { ?>
                <div class="card-actions-bottom">
                    <a href="<?php echo base_url('item/form/' . $item['id']); ?>" class="btn-icon btn-edit-sm">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        Modifier
                    </a>
                    <a href="<?php echo base_url('item/delete/' . $item['id']); ?>"
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
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </details>
    <?php } ?>
</section>
<?php } ?>
<?php } ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn-increment');

    buttons.forEach(button => {
        // Empêche le clic du bouton de déclencher le lien de la carte globale
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const itemId = this.getAttribute('data-id');

            fetch('<?php echo base_url("item/increment-episode/"); ?>' + itemId, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>' // Protection CSRF CodeIgniter
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Met à jour le numéro d'épisode dans la carte visuellement
                        document.getElementById('ep-count-' + itemId).innerText = data
                            .new_episode;

                        // Optionnel : petite animation visuelle (feedback)
                        this.style.color = 'var(--success)';
                        setTimeout(() => {
                            this.style.color = 'white';
                        }, 1000);
                    } else {
                        alert('Erreur: ' + data.message);
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });
    });
});
</script>