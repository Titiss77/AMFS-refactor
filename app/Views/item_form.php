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
                    <?php $currentStatus = isset($item) ? $item->status : 'À voir'; ?>
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
        alert("Entre d'abord un titre d'anime !");
        return;
    }

    const statusTxt = document.getElementById('api-status');
    statusTxt.style.display = 'inline';
    statusTxt.innerText = '⏳ Recherche...';

    try {
        const response = await fetch(
            `https://api.jikan.moe/v4/anime?q=${encodeURIComponent(titreInput)}&limit=1`);
        const data = await response.json();

        if (data.data && data.data.length > 0) {
            const anime = data.data[0];
            document.getElementById('titre').value = anime.title;
            document.getElementById('img').value = anime.images.jpg.large_image_url || anime.images.jpg
                .image_url;

            // Description (coupée proprement si trop longue pour ta BDD)
            let desc = anime.synopsis ? anime.synopsis.substring(0, 50) + "..." : "";
            document.getElementById('description').value = desc;

            statusTxt.innerText = '✅ Trouvé !';
        } else {
            statusTxt.innerText = '❌ Non trouvé';
        }
    } catch (e) {
        statusTxt.innerText = 'Erreur API';
    }
});
</script>