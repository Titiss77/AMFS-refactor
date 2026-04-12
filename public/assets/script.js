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