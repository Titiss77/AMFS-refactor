<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

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
<?php if (auth()->user()->inGroup('admin')) { ?>
<a href="<?php echo base_url('users'); ?>" class="btn btn-warning">Gérer les utilisateurs</a>
<?php } ?>
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
<?php
    // Lecture de l'URL au lieu de la session (Infaillible)
    $openDivision = $_GET['open'] ?? null;
?>

<?php foreach ($groupedItems as $headerName => $divisions) { ?>
<section class="header-section">
    <h2 class="header-title">
        <?php echo htmlspecialchars($headerName); ?>
    </h2>

    <?php
    foreach ($divisions as $divisionName => $items) {
        $currentDivisionId = !empty($items) ? $items[0]->id_division : null;
        $isOpen = ($openDivision && $openDivision == $currentDivisionId) ? 'open' : '';
        ?>
    <details class="division-section" id="div-<?php echo $currentDivisionId; ?>" <?php echo $isOpen; ?>>
        <summary class="division-title">
            <span class="toggle-icon">&#x25B6;</span> <?php echo htmlspecialchars($divisionName); ?>
        </summary>

        <div class="cards-grid sortable-grid">
            <?php foreach ($items as $item) { ?>
            <div class="card fade-in searchable-card <?php echo $item->status === 'Terminé' ? 'status-completed' : ''; ?>"
                data-id="<?= esc($item->id) ?>">
                <div class="drag-handle" style="cursor: grab; text-align: center; color: #ccc; padding: 5px;">
                    &#x2630; </div>

                <a href="<?php echo htmlspecialchars($item->getFinalLink()); ?>" target="_blank"
                    class="card-link-block">
                    <div class="card-body">

                        <?php
                        $isFuture = false;
                        $dateSortieFormatted = '';
                        $textColor = '';

                        if (!empty($item->date_sortie)) {
                            // On définit le fuseau horaire sur Paris
                            $timezone = new \DateTimeZone('Europe/Paris');

                            // On applique ce fuseau aux deux dates
                            $dateSortie = new \DateTime($item->date_sortie, $timezone);
                            $now = new \DateTime('now', $timezone);

                            if ($dateSortie > $now) {
                                $isFuture = true;
                                $dateSortieFormatted = $dateSortie->format('d/m/Y à H:i');
                                $textColor = 'color: red;';
                            }
                        }
                        ?>

                        <h4 class="card-title" style="<?php echo $textColor; ?>">
                            <?php echo htmlspecialchars($item->titre); ?></h4>

                        <?php if ($isFuture) { ?>
                        <p class="card-date" style="<?php echo $textColor; ?>">
                            ⏳ Suivant le : <?php echo $dateSortieFormatted; ?>
                        </p>
                        <?php } ?>

                        <p style="font-size: 0.8rem; color: gray; margin: 0;">Status :
                            <?php echo htmlspecialchars($item->status); ?></p>

                        <?php if (!empty($item->description)) { ?>
                        <p class="card-desc">
                            <?php echo htmlspecialchars($item->description); ?></p>
                        <?php } ?>

                        <div class="card-badges">
                            <?php if (!empty($item->saison)) { ?>
                            <span class="badge badge-season">Saison
                                <?php echo htmlspecialchars($item->saison); ?></span>
                            <?php } ?>

                            <?php if (!empty($item->episode)) { ?>
                            <span class="badge badge-episode">
                                Ép. <span
                                    id="ep-count-<?php echo $item->id; ?>"><?php echo htmlspecialchars($item->episode); ?></span>
                                <?php if (auth()->loggedIn() && (int) $item->id_user === (int) auth()->id()) { ?>
                                <button type="button" class="btn-increment"
                                    data-id="<?php echo $item->id; ?>">+1</button>
                                <?php } ?>
                            </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-image">
                        <?php if (!empty($item->image)) { ?>
                        <img src="<?php echo htmlspecialchars($item->image); ?>"
                            alt="<?php echo htmlspecialchars($item->titre); ?>" class="image-view">
                        <?php } ?>
                    </div>
                </a>

                <?php if (auth()->loggedIn() && (int) $item->id_user === (int) auth()->id()) { ?>
                <div class="card-actions-bottom">
                    <a href="<?php echo base_url('item/form/' . $item->id); ?>"
                        class="btn-icon btn-edit-sm">Modifier</a>
                    <a href="<?php echo base_url('item/delete/' . $item->id); ?>" onclick="return confirm('Sûr ?');"
                        class="btn-icon btn-delete-sm">Supprimer</a>
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

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- 1. BOUTON +1 EPISODE (AJAX) ---
    // (querySelectorAll ne plante pas même s'il ne trouve rien, donc c'est sécurisé par défaut)
    const buttons = document.querySelectorAll('.btn-increment');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const itemId = this.getAttribute('data-id');
            fetch('<?php echo base_url('item/increment-episode/'); ?>' + itemId, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('ep-count-' + itemId).innerText = data
                            .new_episode;
                    }
                });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // 1. On sélectionne TOUTES les grilles (toutes les divisions) avec la classe
    var grids = document.querySelectorAll('.sortable-grid');

    grids.forEach(function(el) {
        // Initialiser SortableJS pour chaque grille
        Sortable.create(el, {
            animation: 150,
            ghostClass: 'bg-light',

            // On dit à Sortable d'utiliser UNIQUEMENT l'élément avec la classe .drag-handle
            handle: '.drag-handle',

            // (Tu peux du coup retirer les options delay, delayOnTouchOnly, touchStartThreshold)

            onEnd: function(evt) {
                // 2. CORRECTION : On cherche la classe '.card' et non plus '.card-item'
                var itemEls = el.querySelectorAll('.card');
                var newOrder = [];

                itemEls.forEach(function(item) {
                    var id = item.getAttribute('data-id');
                    if (id) {
                        newOrder.push(id);
                    }
                });

                // 3. CORRECTION : Ajout des headers CSRF pour éviter l'erreur 403 de CodeIgniter
                fetch('<?= base_url('/items/update-order') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            '<?= csrf_header() ?>': '<?= csrf_hash() ?>' // Indispensable !
                        },
                        body: JSON.stringify({
                            order: newOrder
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error('Erreur lors de la sauvegarde de l\'ordre.');
                        } else {
                            console.log('Ordre sauvegardé avec succès !');
                        }
                    })
                    .catch(error => console.error('Erreur réseau:', error));
            }
        });
    });
});
</script>
<?= $this->endSection() ?>