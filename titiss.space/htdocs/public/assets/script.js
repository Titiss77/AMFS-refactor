// ==========================================
// 1. SYSTEME DE NOTIFICATIONS (TOASTS) 
// ==========================================
window.showToast = function(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerText = message;
    
    container.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 50);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 4000);
};

// ==========================================
// INITIALISATION DES ELEMENTS DU DOM
// ==========================================
document.addEventListener('DOMContentLoaded', function() {

    function svgWithColor($color) {
        if ($color === 'Sombre') {
            return `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="currentColor" class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z" />
            </svg>
            `;
        } else if ($color === 'Clair') {
            return `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun-fill" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                </svg>
                `;
        }
    }

    // ==========================================
    // 2. THEME SOMBRE (Dark Mode)
    // ==========================================
    const themeToggleBtn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    const metaThemeColor = document.getElementById('meta-theme-color');
    
    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        if(themeToggleBtn) themeToggleBtn.innerHTML = svgWithColor('Clair');
        if(metaThemeColor) metaThemeColor.setAttribute('content', '#09090b');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        document.documentElement.setAttribute('data-bs-theme', 'light');
        if(metaThemeColor) metaThemeColor.setAttribute('content', '#fcfcfd');
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            let theme = document.documentElement.getAttribute('data-theme');
            let switchToTheme = theme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', switchToTheme);
            document.documentElement.setAttribute('data-bs-theme', switchToTheme);
            localStorage.setItem('theme', switchToTheme);
            themeToggleBtn.innerHTML = switchToTheme === 'dark' ? svgWithColor('Clair') : svgWithColor('Sombre');
            if(metaThemeColor) {
                metaThemeColor.setAttribute('content', switchToTheme === 'dark' ? '#09090b' : '#fcfcfd');
            }
        });
    }

    // ==========================================
    // 3. COMPTEUR DE CARACTERES (Description)
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
    // 4. INCREMENTATION ASYNCHRONE (+1 Episode)
    // ==========================================
    document.querySelectorAll('.btn-increment').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            e.stopPropagation();

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

                if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);

                const data = await response.json();

                if (data.success) {
                    counterSpan.innerText = data.new_episode;
                    counterSpan.style.color = 'var(--success)';
                    counterSpan.style.transform = 'scale(1.2)';
                    
                    setTimeout(() => {
                        counterSpan.style.color = '';
                        counterSpan.style.transform = 'scale(1)';
                    }, 400);

                    if (data.csrf_token) amfsConfig.csrfToken = data.csrf_token; 
                    if (typeof showToast === 'function') showToast('Episode ajoute avec succes !', 'success');
                } else {
                    console.error("Erreur renvoyee par PHP :", data);
                }
            } catch (error) {
                console.error("Echec de la requete Fetch :", error);
            }
        });
    });

    // ==========================================
    // 5. BOUTONS DE CHARGEMENT SUR FORMULAIRES
    // ==========================================
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && this.checkValidity()) {
                submitBtn.classList.add('loading');
            }
        });
    });

    // ==========================================
    // 6. TOGGLE VISIBILITE MOT DE PASSE
    // ==========================================
    document.querySelectorAll('.password-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            const wrapper = this.closest('.password-wrapper');
            const input = wrapper.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                this.textContent = '👁️';
            } else {
                input.type = 'password';
                this.textContent = '🙈';
            }
        });
    });

    // ==========================================
    // 7. RECHERCHE EN DIRECT (Live Search)
    // ==========================================
    const searchInput = document.getElementById('liveSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.searchable-card, .card'); 

            cards.forEach(card => {
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
    // 8. DRAG AND DROP (SortableJS)
    // ==========================================
    var grids = document.querySelectorAll('.sortable-grid');
    if (typeof Sortable !== 'undefined') {
        grids.forEach(function(el) {
            Sortable.create(el, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                delay: 200,             
                delayOnTouchOnly: true, 
                onEnd: async function(evt) {
                    if (evt.oldIndex === evt.newIndex) return; 

                    var itemEls = el.querySelectorAll('.card');
                    var newOrder = [];

                    itemEls.forEach(function(item) {
                        var id = item.getAttribute('data-id');
                        if (id) newOrder.push(id);
                    });

                    try {
                        const response = await fetch(amfsConfig.updateOrderUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                [amfsConfig.csrfHeader]: amfsConfig.csrfToken
                            },
                            body: JSON.stringify({ order: newOrder })
                        });

                        const data = await response.json();
                        
                        if (data.csrf_token) {
                            amfsConfig.csrfToken = data.csrf_token;
                        }

                    } catch (err) {
                        console.error("Erreur Drag&Drop:", err);
                        if (typeof showToast === 'function') showToast("Erreur lors de la sauvegarde de l'ordre", "danger");
                    }
                }
            });
        });
    }

    // ==========================================
    // 9. AUTO-REMPLISSAGE UNIFIE (Avec Selection)
    // ==========================================
    const btnApiSearch = document.getElementById('btn-api-search');
    const resultsContainer = document.getElementById('api-results-container');

    if (btnApiSearch && resultsContainer) {
        document.addEventListener('click', function(event) {
            if (!resultsContainer.contains(event.target) && event.target !== btnApiSearch && event.target.id !== 'titre') {
                resultsContainer.style.display = 'none';
            }
        });

        btnApiSearch.addEventListener('click', async function() {
            const titreInput = document.getElementById('titre').value.trim();
            if (!titreInput) {
                showToast("Entre d'abord un titre ou un lien !", "danger");
                return;
            }

            const statusTxt = document.getElementById('api-status');
            statusTxt.style.display = 'inline';
            statusTxt.innerText = 'Recherche en cours...';
            resultsContainer.innerHTML = '';
            resultsContainer.style.display = 'none';

            let typeSelectionne = 'film';
            const divisionSelect = document.getElementById('id_division');
            if (divisionSelect && divisionSelect.selectedIndex >= 0) {
                const divText = divisionSelect.options[divisionSelect.selectedIndex].text.toLowerCase();
                if (divText.includes('manga')) typeSelectionne = 'manga';
                else if (divText.includes('anime') || divText.includes('animé')) typeSelectionne = 'anime';
                else if (divText.includes('série') || divText.includes('serie')) typeSelectionne = 'serie';
                else if (divText.includes('lien') || divText.includes('web') || divText.includes('autre')) typeSelectionne = 'lien';
            }

            if (titreInput.startsWith('http://') || titreInput.startsWith('https://')) {
                typeSelectionne = 'lien';
            }

            const baseUrl = amfsConfig.baseUrl.endsWith('/') ? amfsConfig.baseUrl : amfsConfig.baseUrl + '/';
            const url = `${baseUrl}item/search?q=${encodeURIComponent(titreInput)}&type=${typeSelectionne}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.error) {
                    showToast(data.error, "danger");
                    statusTxt.innerText = 'Erreur';
                    return;
                }

                const descField = document.getElementById('description');
                const maxDescLength = descField && descField.hasAttribute('maxlength') ? parseInt(descField.getAttribute('maxlength')) : 250;
                const limitCut = maxDescLength > 3 ? maxDescLength - 3 : maxDescLength;

                let listeResultats = [];

                if (data.data && data.data.length > 0) {
                    listeResultats = data.data.map(item => ({
                        titre: item.title,
                        imageThumb: item.images?.jpg?.image_url || '',
                        imageLarge: item.images?.jpg?.large_image_url || item.images?.jpg?.image_url || '',
                        description: item.synopsis ? (item.synopsis.length > limitCut ? item.synopsis.substring(0, limitCut) + "..." : item.synopsis) : "",
                        info: (item.year || '') + ' - ' + (item.type || typeSelectionne).toUpperCase(),
                        lien: ''
                    }));
                } else if (data.results && data.results.length > 0) {
                    listeResultats = data.results.map(item => ({
                        titre: item.title || item.name || item.original_name,
                        imageThumb: item.poster_path ? `https://image.tmdb.org/t/p/w200${item.poster_path}` : '',
                        imageLarge: item.poster_path ? `https://image.tmdb.org/t/p/w500${item.poster_path}` : '',
                        description: item.overview ? (item.overview.length > limitCut ? item.overview.substring(0, limitCut) + "..." : item.overview) : "",
                        info: (item.release_date || item.first_air_date || '').substring(0,4) + ' - ' + (item.media_type || typeSelectionne).toUpperCase(),
                        lien: ''
                    }));
                } else if (Array.isArray(data) && data.length > 0 && data[0].is_link) {
                    listeResultats = [{
                        titre: data[0].titre,
                        imageThumb: data[0].image,
                        imageLarge: data[0].image,
                        description: data[0].description ? (data[0].description.length > limitCut ? data[0].description.substring(0, limitCut) + "..." : data[0].description) : "",
                        info: "LIEN WEB",
                        lien: data[0].lien
                    }];
                }

                if (listeResultats.length > 0) {
                    statusTxt.innerText = `${listeResultats.length} resultat(s)`;
                    resultsContainer.style.display = 'block';

                    listeResultats.forEach(res => {
                        const divItem = document.createElement('div');
                        divItem.style.cssText = 'display: flex; align-items: center; padding: 10px; border-bottom: 1px solid var(--border-color); cursor: pointer; transition: background 0.2s;';
                        
                        divItem.onmouseover = () => divItem.style.background = 'rgba(128, 128, 128, 0.1)';
                        divItem.onmouseout = () => divItem.style.background = 'transparent';

                        const fallbackImg = 'https://via.placeholder.com/40x60?text=IMG';
                        const imgSrc = res.imageThumb || fallbackImg;

                        divItem.innerHTML = `
                            <img src="${imgSrc}" alt="Affiche" style="width: 40px; height: 60px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                            <div style="flex-grow: 1; overflow: hidden;">
                                <strong style="display: block; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">${res.titre}</strong>
                                <small style="color: gray;">${res.info}</small>
                            </div>
                        `;

                        divItem.addEventListener('click', () => {
                            document.getElementById('titre').value = res.titre;
                            
                            const imgField = document.getElementById('img');
                            if (res.imageLarge && imgField) {
                                imgField.value = res.imageLarge;
                                imgField.dispatchEvent(new Event('input')); 
                            }

                            if (res.description) document.getElementById('description').value = res.description;
                            
                            const inputLien = document.getElementById('lien');
                            if (res.lien && inputLien) inputLien.value = res.lien;
                            
                            if (textarea) textarea.dispatchEvent(new Event('input'));
                            
                            resultsContainer.style.display = 'none';
                            statusTxt.innerText = 'Selectionne !';
                            showToast("Formulaire mis a jour.", "success");
                        });

                        resultsContainer.appendChild(divItem);
                    });

                } else {
                    statusTxt.innerText = 'Aucun resultat';
                    resultsContainer.style.display = 'none';
                }
            } catch (e) {
                console.error("Erreur Fetch API:", e);
                statusTxt.innerText = 'Erreur serveur';
            }
        });
    }

    // ==========================================
    // 10. APERÇU EN DIRECT DE L'IMAGE
    // ==========================================
    const imgInput = document.getElementById('img');
    const imgPreview = document.getElementById('img-preview');
    const imgPlaceholder = document.getElementById('img-placeholder');

    if (imgInput && imgPreview && imgPlaceholder) {
        imgInput.addEventListener('input', function() {
            const url = this.value.trim();
            if (url) {
                imgPreview.src = url;
                imgPreview.style.display = 'block';
                imgPlaceholder.style.display = 'none';
            } else {
                imgPreview.style.display = 'none';
                imgPlaceholder.style.display = 'block';
                imgPlaceholder.innerText = 'Apercu';
                imgPlaceholder.style.color = 'var(--text-muted)';
                imgPreview.src = '';
            }
        });
        
        imgPreview.addEventListener('error', function() {
            this.style.display = 'none';
            imgPlaceholder.style.display = 'block';
            imgPlaceholder.innerHTML = 'Erreur';
            imgPlaceholder.style.color = 'var(--danger)'; 
        });

        imgPreview.addEventListener('load', function() {
            imgPlaceholder.style.color = 'var(--text-muted)';
            imgPlaceholder.innerText = 'Apercu';
        });
    }

});