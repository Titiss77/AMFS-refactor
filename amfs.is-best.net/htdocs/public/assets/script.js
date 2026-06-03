document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('char-count');

    // On s'assure que les éléments existent sur la page pour éviter les erreurs JS
    if (textarea && charCount) {
        const maxLength = textarea.getAttribute('maxlength');

        // Fonction qui calcule et affiche la longueur
        function updateCounter() {
            const currentLength = textarea.value.length;
            charCount.textContent = `${currentLength} / ${maxLength}`;

            // Petit bonus UX : On met le texte en rouge si on atteint la limite
            if (currentLength >= maxLength) {
                charCount.style.color = 'var(--danger)';
            } else {
                charCount.style.color = 'var(--text-muted)';
            }
        }

        // 1. Initialiser le compteur au chargement de la page 
        // (Super important pour le mode "Modification" si la description n'est pas vide !)
        updateCounter();

        // 2. Mettre à jour le compteur à chaque fois que l'utilisateur tape quelque chose
        textarea.addEventListener('input', updateCounter);
    }
});
document.addEventListener('DOMContentLoaded', () => {

    // 1. SYSTÈME DE NOTIFICATIONS (TOASTS)
    window.showToast = function(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast toast-${type} fade-in`;
        toast.innerText = message;
        
        container.appendChild(toast);
        
        // Disparaît après 3 secondes
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };

    // 2. INCRÉMENTATION ASYNCHRONE (Fetch API)
    const csrfHeader = document.querySelector('meta[name="csrf-header"]').getAttribute('content');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 1. On écoute la bonne classe : .btn-increment
    document.querySelectorAll('.btn-increment').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            
            // 2. LA LIGNE MAGIQUE : Empêche le clic de remonter et d'ouvrir le lien <a>
            e.stopPropagation(); 

            const itemId = button.getAttribute('data-id');
            
            // 3. On construit l'URL avec la configuration globale (pas besoin de data-url)
            const url = amfsConfig.baseUrl + 'item/increment-episode/' + itemId;
            
            // 4. On cible le bon ID : ep-count-{id} (et non episode-count)
            const counterSpan = document.getElementById(`ep-count-${itemId}`);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        [csrfHeader]: csrfToken // Sécurité CSRF
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Mise à jour visuelle instantanée
                    counterSpan.innerText = data.new_episode;
                    
                    // Petit effet visuel agréable
                    counterSpan.style.color = 'var(--success)';
                    counterSpan.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        counterSpan.style.color = '';
                        counterSpan.style.transform = 'scale(1)';
                    }, 400);

                    if(data.csrf_token) {
                        csrfToken = data.csrf_token; // Mise à jour du token
                    }
                    showToast('Épisode ajouté avec succès !');
                }
            } catch (error) {
                console.error("Erreur Fetch:", error);
                showToast('Erreur lors de l\'ajout', 'danger');
            }
        });
    });

    // 3. RECHERCHE EN DIRECT (Filtre sans rechargement)
    const searchInput = document.getElementById('liveSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.card'); // Assure-toi que tes éléments ont la classe .card

            cards.forEach(card => {
                const title = card.querySelector('.card-title')?.innerText.toLowerCase() || '';
                const desc = card.querySelector('.card-desc')?.innerText.toLowerCase() || '';
                
                if (title.includes(term) || desc.includes(term)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // --- C. DRAG AND DROP (SORTABLEJS) ---
    var grids = document.querySelectorAll('.sortable-grid');
    grids.forEach(function(el) {
        Sortable.create(el, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            handle: '.drag-handle',
            
            // --- LE CORRECTIF POUR MOBILE ---
            delay: 200,             // Oblige à maintenir le doigt 200 millisecondes
            delayOnTouchOnly: true, // Ce délai ne s'applique QUE sur les smartphones
            // --------------------------------

            onEnd: function(evt) {
                // Si la position finale est identique à la position initiale, on annule
                if (evt.oldIndex === evt.newIndex) {
                    return; 
                }

                var itemEls = el.querySelectorAll('.card');
                var newOrder = [];

                itemEls.forEach(function(item) {
                    var id = item.getAttribute('data-id');
                    if (id) {
                        newOrder.push(id);
                    }
                });

                fetch(amfsConfig.updateOrderUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        // Utilisation des crochets pour définir une clé d'objet dynamique
                        [amfsConfig.csrfHeader]: amfsConfig.csrfToken
                    },
                    body: JSON.stringify({
                        order: newOrder
                    })
                })
            }
        });
    });

    // --- F. AUTO-REMPLISSAGE API (TMDb) ---
    const btnApiSearch = document.getElementById('btn-api-search');
    if (btnApiSearch) { // On vérifie si on est bien sur la page du formulaire
        btnApiSearch.addEventListener('click', async function() {
            const titreInput = document.getElementById('titre').value;
            if (!titreInput) {
                alert("Entre d'abord un titre !");
                return;
            }

            const statusTxt = document.getElementById('api-status');
            statusTxt.style.display = 'inline';
            statusTxt.innerText = '⏳ Recherche en cours...';

            const apiKey = '9774091bee3bd236f4438cd6d8caa8d8';
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
                    
                    // Met à jour le compteur de caractères si la description a changé
                    const textarea = document.getElementById('description');
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