<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<?php if (!auth()->loggedIn()) { ?>
<div class="empty-state shadow-card">
    <h2>Bienvenue sur AMFS Dashboard</h2>
    <p style="color: var(--danger);">Seuls les Liens & Outils sont accessibles sans être connecté.</p>
    <p>Veuillez vous connecter ou créer un compte pour gérer et visualiser vos propres cartes.</p>
    <br>
    <a href="<?php echo base_url('login'); ?>" class="btn btn-primary">Se connecter</a>
    <a href="<?php echo base_url('register'); ?>" class="btn btn-primary">Créer un compte</a>
</div>
<?php } else { ?>
<div class="actions-container">
    <?php if (auth()->user()->inGroup('admin', 'superadmin')) { ?>
    <a href="<?php echo base_url('users'); ?>" class="btn btn-warning" style="margin-right: 15px;">Gérer les
        utilisateurs</a>

    <a href="<?php echo base_url('items/pending'); ?>" class="btn btn-info" style="margin-right: 15px;">
        Cartes en attente
        <?php if (isset($pendingCount) && $pendingCount > 0) { ?>
        <span
            style="background-color: var(--danger, #dc3545); color: white; border-radius: 50%; padding: 2px 8px; font-size: 0.85rem; font-weight: bold; margin-left: 5px;">
            <?php echo $pendingCount; ?>
        </span>
        <?php } ?>
    </a>
    <?php } ?>
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

<div class="search-container" style="margin-bottom: 2rem;">
    <input type="text" id="liveSearch" class="form-control" placeholder="Rechercher une œuvre... (titre, description)"
        autocomplete="off">
</div>

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
            <div class="card fade-in searchable-card <?php echo 'Terminé' === $item->status ? 'status-completed' : ''; ?>"
                data-id="<?php echo esc($item->id); ?>">

                <div class="drag-handle" style="cursor: grab; text-align: center; color: #ccc; padding: 5px;"
                    title="Déplacer cette carte">
                    &#x2630;
                </div>

                <a href="<?php echo htmlspecialchars($item->getFinalLink()); ?>" target="_blank"
                    class="card-link-block">
                    <div class="card-body">

                        <?php
                        $isFuture = false;
                        $dateSortieFormatted = '';
                        $textColor = '';

                        if (!empty($item->date_sortie)) {
                            // On définit le fuseau horaire sur Paris
                            $timezone = new DateTimeZone('Europe/Paris');

                            // On applique ce fuseau aux deux dates
                            $dateSortie = new DateTime($item->date_sortie, $timezone);
                            $now = new DateTime('now', $timezone);

                            if ($dateSortie > $now) {
                                $isFuture = true;
                                $dateSortieFormatted = $dateSortie->format('d/m/Y à H:i');
                                $textColor = 'color: var(--danger);';  // Utilisation d'une variable CSS plutôt que "red" brut
                            }
                        }
                        ?>

                        <h4 class="card-title search-target-title" style="<?php echo $textColor; ?>">
                            <?php echo htmlspecialchars($item->titre); ?>
                        </h4>

                        <?php if ($isFuture) { ?>
                        <p class="card-date" style="<?php echo $textColor; ?>">
                            ⏳ Suivant le : <?php echo $dateSortieFormatted; ?>
                        </p>
                        <?php } ?>

                        <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0;">Status :
                            <?php echo htmlspecialchars($item->status); ?>
                        </p>
                        <?php if ($item->is_public == 2 && auth()->loggedIn() && (int) $item->id_user === (int) auth()->id()) { ?>
                        <div
                            style="background-color: var(--warning, #ffc107); color: #000; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem; display: inline-block; margin-top: 5px; margin-bottom: 5px;">
                            ⏳ En cours d'inspection (Non public)
                        </div>
                        <?php } ?>

                        <?php if (!empty($item->description)) { ?>
                        <p class="card-desc search-target-desc">
                            <?php echo htmlspecialchars($item->description); ?>
                        </p>
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
                            alt="<?php echo htmlspecialchars($item->titre); ?>" class="image-view" loading="lazy">
                        <?php } ?>
                    </div>
                </a>

                <?php if (auth()->loggedIn() && (int) $item->id_user === (int) auth()->id()) { ?>
                <div class="card-actions-bottom">
                    <a href="<?php echo base_url('item/form/' . $item->id); ?>"
                        class="btn-icon btn-edit-sm">Modifier</a>
                    <a href="<?php echo base_url('item/delete/' . $item->id); ?>"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette carte ?');"
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

    // --- A. RECHERCHE EN DIRECT (LIVE SEARCH) ---
    const searchInput = document.getElementById('liveSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.searchable-card');

            cards.forEach(card => {
                const titleEl = card.querySelector('.search-target-title');
                const descEl = card.querySelector('.search-target-desc');

                const title = titleEl ? titleEl.innerText.toLowerCase() : '';
                const desc = descEl ? descEl.innerText.toLowerCase() : '';

                if (title.includes(term) || desc.includes(term)) {
                    card.style.display = 'flex'; // Respecte le layout flex de ta carte
                } else {
                    card.style.display = 'none'; // Masque la carte instantanément
                }
            });
        });
    }

    // --- B. BOUTON +1 EPISODE (AJAX AVEC RETOUR VISUEL) ---
    const buttons = document.querySelectorAll('.btn-increment');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Évite de cliquer accidentellement sur le lien principal

            const itemId = this.getAttribute('data-id');
            const url = '<?php echo base_url('item/increment-episode/'); ?>' + itemId;

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const counterSpan = document.getElementById('ep-count-' + itemId);
                        counterSpan.innerText = data.new_episode;

                        // Petit effet visuel agréable (Pulse vert rapide)
                        counterSpan.style.color = 'var(--success)';
                        counterSpan.style.transform = 'scale(1.2)';
                        counterSpan.style.display = 'inline-block';
                        counterSpan.style.transition = 'all 0.3s ease';

                        setTimeout(() => {
                            counterSpan.style.color = '';
                            counterSpan.style.transform = 'scale(1)';
                        }, 600);
                    }
                })
                .catch(err => console.error("Erreur lors de l'incrémentation :", err));
        });
    });

    // --- C. DRAG AND DROP (SORTABLEJS) ---
    var grids = document.querySelectorAll('.sortable-grid');
    grids.forEach(function(el) {
        Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost', // Assure-toi d'avoir mis cette classe dans ton CSS (étape précédente)
            handle: '.drag-handle',

            onEnd: function(evt) {
                var itemEls = el.querySelectorAll('.card');
                var newOrder = [];

                itemEls.forEach(function(item) {
                    var id = item.getAttribute('data-id');
                    if (id) {
                        newOrder.push(id);
                    }
                });

                fetch('<?php echo base_url('items/update-order'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            '<?php echo csrf_header(); ?>': '<?php echo csrf_hash(); ?>'
                        },
                        body: JSON.stringify({
                            order: newOrder
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error('Erreur lors de la sauvegarde de l\'ordre.');
                        }
                    })
                    .catch(error => console.error('Erreur réseau:', error));
            }
        });
    });

});
</script>
<?php echo $this->endSection(); ?>