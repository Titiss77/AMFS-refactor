document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // 0. COMPTEUR DE CARACTÈRES (Description)
    // ==========================================
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('char-count');

    if (textarea && charCount) {
        const maxLength = textarea.getAttribute('maxlength');

        function updateCounter() {
            const currentLength = textarea.value.length;
            charCount.textContent = `${currentLength} / ${maxLength}`;
            if (currentLength >= maxLength) {
                charCount.style.color = 'var(--danger)';
            } else {
                charCount.style.color = 'var(--text-muted)';
            }
        }
        updateCounter();
        textarea.addEventListener('input', updateCounter);
    }

    // ==========================================
    // 1. SYSTÈME DE NOTIFICATIONS (TOASTS)
    // ==========================================
    window.showToast = function(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return; // Sécurité si le conteneur n'existe pas

        const toast = document.createElement('div');
        toast.className = `toast toast-${type} fade-in`;
        toast.innerText = message;
        
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };

    // ==========================================
    // 2. INCRÉMENTATION ASYNCHRONE (+1 Épisode)
    // ==========================================
    document.querySelectorAll('.btn-increment').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            e.stopPropagation(); // Empêche la redirection vers le lien de la carte

            const itemId = button.getAttribute('data-id');
            const baseUrl = amfsConfig.baseUrl.endsWith('/') ? amfsConfig.baseUrl : amfsConfig.baseUrl + '/';
            const url = baseUrl + 'item/increment-episode/' + itemId;
            const counterSpan = document.getElementById(`ep-count-${itemId}`);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        [amfsConfig.csrfHeader]: amfsConfig.csrfToken
                    }
                });

                if (!response.ok) {
                    throw new Error(`Erreur HTTP: ${response.status}`);
                }

                const data = await response.json();

                if (data.success) {
                    counterSpan.innerText = data.new_episode;
                    counterSpan.style.color = 'var(--success)';
                    counterSpan.style.transform = 'scale(1.2)';
                    
                    setTimeout(() => {
                        counterSpan.style.color = '';
                        counterSpan.style.transform = 'scale(1)';
                    }, 400);

                    if (data.csrf_token) {
                        amfsConfig.csrfToken = data.csrf_token; 
                    }
                    
                    if (typeof showToast === 'function') {
                        showToast('Épisode ajouté avec succès !');
                    }
                } else {
                    console.error("Erreur renvoyée par PHP :", data);
                }
            } catch (error) {
                console.error("Échec de la requête Fetch :", error);
            }
        });
    });

    // ==========================================
    // 3. RECHERCHE EN DIRECT (Live Search)
    // ==========================================
    const searchInput = document.getElementById('liveSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            // Utilise la classe .searchable-card pour être sûr de cibler les bons éléments
            const cards = document.querySelectorAll('.searchable-card, .card'); 

            cards.forEach(card => {
                // On cherche dans les titres et descriptions
                const title = card.querySelector('.card-title, .search-target-title')?.innerText.toLowerCase() || '';
                const desc = card.querySelector('.card-desc, .search-target-desc')?.innerText.toLowerCase() || '';
                
                if (title.includes(term) || desc.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // ==========================================
    // 4. DRAG AND DROP (SortableJS)
    // ==========================================
    var grids = document.querySelectorAll('.sortable-grid');
    if (typeof Sortable !== 'undefined') { // Sécurité si SortableJS n'est pas chargé
        grids.forEach(function(el) {
            Sortable.create(el, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                delay: 200,             
                delayOnTouchOnly: true, 
                onEnd: function(evt) {
                    if (evt.oldIndex === evt.newIndex) return; 

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
                    }).catch(err => console.error("Erreur Drag&Drop:", err));
                }
            });
        });
    }

    // ==========================================
    // 5. AUTO-REMPLISSAGE API (TMDb)
    // ==========================================
    const btnApiSearch = document.getElementById('btn-api-search');
    if (btnApiSearch) {
        btnApiSearch.addEventListener('click', async function() {
            const titreInput = document.getElementById('titre').value;
            if (!titreInput) {
                alert("Entre d'abord un titre !");
                return;
            }

            const statusTxt = document.getElementById('api-status');
            statusTxt.style.display = 'inline';
            statusTxt.innerText = '⏳ Recherche en cours...';

            // Utilise la clé API depuis la configuration globale amfsConfig
            const apiKey = amfsConfig.tmdbApiKey || '9774091bee3bd236f4438cd6d8caa8d8';
            const url = `https://api.themoviedb.org/3/search/tv?api_key=${apiKey}&language=fr-FR&query=${encodeURIComponent(titreInput)}&page=1`;

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
                    
                    if (textarea) {
                        textarea.dispatchEvent(new Event('input')); 
                    }

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