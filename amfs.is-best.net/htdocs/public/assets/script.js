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
                    card.style.display = 'flex'; 
                } else {
                    card.style.display = 'none'; 
                }
            });
        });
    }

    // --- B. BOUTON +1 EPISODE (AJAX) ---
    const buttons = document.querySelectorAll('.btn-increment');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const itemId = this.getAttribute('data-id');
            // Utilisation de l'URL de base dynamique via amfsConfig
            const url = amfsConfig.baseUrl + 'item/increment-episode/' + itemId;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    [amfsConfig.csrfHeader]: amfsConfig.csrfToken // Token dynamique
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const counterSpan = document.getElementById('ep-count-' + itemId);
                    counterSpan.innerText = data.new_episode;

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
    const grids = document.querySelectorAll('.sortable-grid');
    if (typeof Sortable !== 'undefined') {
        grids.forEach(function(el) {
            Sortable.create(el, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                onEnd: function(evt) {
                    var itemEls = el.querySelectorAll('.card');
                    var newOrder = [];

                    itemEls.forEach(function(item) {
                        var id = item.getAttribute('data-id');
                        if (id) newOrder.push(id);
                    });

                    fetch(amfsConfig.updateOrderUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            [amfsConfig.csrfHeader]: amfsConfig.csrfToken
                        },
                        body: JSON.stringify({ order: newOrder })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) console.error('Erreur lors de la sauvegarde de l\'ordre.');
                    })
                    .catch(error => console.error('Erreur réseau:', error));
                }
            });
        });
    }

    // --- D. NETTOYAGE URL ---
    const currentUrl = new URL(window.location.href);
    if (currentUrl.searchParams.has('open') || currentUrl.hash) {
        setTimeout(() => {
            window.history.replaceState({}, document.title, currentUrl.pathname);
        }, 10);
    }

    // --- F. AUTO-REMPLISSAGE API (TMDb) ---
    const btnApiSearch = document.getElementById('btn-api-search');
    if (btnApiSearch) { // On vérifie si on est sur la page du formulaire
        btnApiSearch.addEventListener('click', async function() {
            const titreInput = document.getElementById('titre').value;
            if (!titreInput) {
                alert("Entre d'abord un titre !");
                return;
            }

            const statusTxt = document.getElementById('api-status');
            statusTxt.style.display = 'inline';
            statusTxt.innerText = '⏳ Recherche en cours...';

            // On utilise la clé stockée dans amfsConfig
            const url = `https://api.themoviedb.org/3/search/tv?api_key=${amfsConfig.tmdbApiKey}&language=fr-FR&query=${encodeURIComponent(titreInput)}&page=1`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.results && data.results.length > 0) {
                    const resultat = data.results[0];

                    document.getElementById('titre').value = resultat.name || resultat.original_name;

                    if (resultat.poster_path) {
                        document.getElementById('img').value = `https://image.tmdb.org/t/p/w500${resultat.poster_path}`;
                    }

                    let desc = resultat.overview ? resultat.overview.substring(0, 100) + "..." : "";
                    document.getElementById('description').value = desc;

                    statusTxt.innerText = '✅ Trouvé (en français) !';
                } else {
                    statusTxt.innerText = '❌ Non trouvé';
                }
            } catch (e) {
                console.error(e);
                statusTxt.innerText = 'Erreur API';
            }
        });
    }
});

// --- E. CRON JOB INVISIBLE ---
window.addEventListener('load', function() {
    setTimeout(function() {
        if (typeof amfsConfig !== 'undefined' && amfsConfig.cronUrl) {
            fetch(amfsConfig.cronUrl).catch(error => console.log('Tâche de fond ignorée.'));
        }
    }, 5000);
});