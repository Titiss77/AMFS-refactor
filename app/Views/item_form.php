<div class="form-container card">
    <h2 class="header-title"><?php echo isset($item) ? '✏️ Modifier la carte' : '+ Ajouter une carte'; ?></h2>

    <form action="<?php echo base_url('item/save'); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo isset($item) ? esc($item->id) : ''; ?>">

        <div style="text-align: right; margin-bottom: 10px;">
            <button type="button" id="btn-api-search" class="btn btn-primary btn-sm">🔍 Auto-remplir l'Anime</button>
            <small id="api-status" style="display:none; color: var(--success);"></small>
        </div>

        <div class="form-group">
            <label for="titre" class="form-label">Titre *</label>
            <input type="text" id="titre" name="titre" class="form-control"
                value="<?php echo isset($item) ? esc($item->titre) : ''; ?>" required>
        </div>

        <div class="form-group row">
            <div class="col-half">
                <label for="id_division" class="form-label">Division *</label>
                <select id="id_division" name="id_division" class="form-control" required>
                    <?php foreach ($divisions as $div) { ?>
                    <option value="<?php echo esc($div['id']); ?>"
                        <?php echo (isset($item) && $item->id_division == $div['id']) ? 'selected' : ''; ?>>
                        <?php echo esc($div['nom']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-half">
                <label for="status" class="form-label">Statut</label>
                <select id="status" name="status" class="form-control">
                    <?php $currentStatus = isset($item) ? $item->status : 'Aucun'; ?>
                    <option value="Aucun" <?php echo $currentStatus == 'Aucun' ? 'selected' : ''; ?>>Aucun</option>
                    <option value="À voir" <?php echo $currentStatus == 'À voir' ? 'selected' : ''; ?>>À voir</option>
                    <option value="En cours" <?php echo $currentStatus == 'En cours' ? 'selected' : ''; ?>>En cours
                    </option>
                    <option value="En pause" <?php echo $currentStatus == 'En pause' ? 'selected' : ''; ?>>En pause
                    </option>
                    <option value="Terminé" <?php echo $currentStatus == 'Terminé' ? 'selected' : ''; ?>>Terminé
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <input type="checkbox" id="is_public" name="is_public" value="1"
                <?php echo (isset($item) && $item->is_public == 1) ? 'checked' : ''; ?>>
            <label for="is_public" class="form-label" style="display:inline;">Rendre ce lien visible au public</label>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"
                rows="1"><?php echo isset($item) ? esc($item->description) : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="img" class="form-label">Image (URL) :</label>
            <input type="text" id="img" name="image" class="form-control"
                value="<?php echo htmlspecialchars($item->image ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="lien" class="form-label">Lien (URL) :</label>
            <input type="text" name="lien" class="form-control"
                value="<?php echo htmlspecialchars($item->lien ?? ''); ?>">
        </div>

        <div class="form-group row">
            <div class="col-half">
                <label for="saison" class="form-label">Saison</label>
                <input type="number" id="saison" name="saison" class="form-control"
                    value="<?php echo isset($item) ? esc($item->saison) : ''; ?>">
            </div>
            <div class="col-half">
                <label for="episode" class="form-label">Épisode</label>
                <input type="text" id="episode" name="episode" class="form-control"
                    value="<?php echo isset($item) ? esc($item->episode) : ''; ?>">
            </div>
        </div>

        <div class="form-actions">
            <a href="<?php echo base_url('/'); ?>" class="btn btn-cancel">Annuler</a>
            <button type="submit" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
</div>

<script>
document.getElementById('btn-api-search').addEventListener('click', async function() {
    const titreInput = document.getElementById('titre').value;
    if (!titreInput) {
        alert("Entre d'abord un titre !");
        return;
    }

    const statusTxt = document.getElementById('api-status');
    statusTxt.style.display = 'inline';
    statusTxt.innerText = '⏳ Recherche en cours...';

    // Il te faudra une clé API gratuite TMDB
    const apiKey = '9774091bee3bd236f4438cd6d8caa8d8';

    // On cherche dans les animes/séries (tv) en français
    const url =
        `https://api.themoviedb.org/3/search/tv?api_key=${apiKey}&language=fr-FR&query=${encodeURIComponent(titreInput)}&page=1`;

    try {
        const response = await fetch(url);
        const data = await response.json();

        if (data.results && data.results.length > 0) {
            const resultat = data.results[0]; // On prend le premier résultat

            // TMDB donne le nom en français
            document.getElementById('titre').value = resultat.name || resultat.original_name;

            // TMDB donne un chemin d'image partiel, il faut rajouter le début de l'URL
            if (resultat.poster_path) {
                document.getElementById('img').value =
                    `https://image.tmdb.org/t/p/w500${resultat.poster_path}`;
            }

            // Le fameux synopsis EN FRANÇAIS ! (limité à 100 caractères pour ton exemple)
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
</script>