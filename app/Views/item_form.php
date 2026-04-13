<div class="form-container card">
    <h2 class="header-title">
        <?php echo isset($item) ? '✏️ Modifier la carte' : '+ Ajouter une carte'; ?>
    </h2>

    <form action="<?php echo base_url('item/save'); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <input type="hidden" name="id" value="<?php echo isset($item) ? esc($item['id']) : ''; ?>">

        <div class="form-group">
            <label for="titre" class="form-label">Titre *</label>
            <input type="text" id="titre" name="titre" class="form-control"
                value="<?php echo isset($item) ? esc($item['titre']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="id_division" class="form-label">Division *</label>
            <select id="id_division" name="id_division" class="form-control" required>
                <?php if (!empty($divisions)) { ?>
                <?php foreach ($divisions as $div) { ?>
                <option value="<?php echo esc($div['id']); ?>"
                    <?php echo (isset($item) && $item['id_division'] == $div['id']) ? 'selected' : ''; ?>>
                    <?php echo esc($div['nom']); ?>
                </option>
                <?php } ?>
                <?php } else { ?>
                <option value="">Aucune division disponible</option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
            <input type="checkbox" id="is_public" name="is_public" value="1"
                <?php echo (isset($item) && $item['is_public'] == 1) ? 'checked' : ''; ?> style="width: auto;">
            <label for="is_public" class="form-label" style="margin-bottom: 0;">Rendre ce lien visible au public (non
                connectés)</label>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="1"
                maxlength="30"><?php echo isset($item) ? esc($item['description']) : ''; ?></textarea>
            <small id="char-count" class="char-counter">0 / 30</small>
        </div>

        <div class="form-group">
            <label for="img" class="form-label">Image (URL) :</label>
            <small>
                💡 Astuce : Copie l'URL d'une image depuis le site de
                <a href="https://www.myutaku.com/" target="_blank"
                    style="color: #007bff; text-decoration: underline;">MyUtaku</a><br>
                Format : 400x600 (2:3) recommandé pour une meilleure qualité d'affichage. <br>
            </small>
            <input type=" text" name="img" class="form-control"
                value="<?php echo htmlspecialchars($item['image'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="lien" class="form-label">Lien (URL) :</label>
            <small>
                💡 Astuce : <b>{s}</b> = saison, <b>{ep}</b> = épisode normal (1). <br>
                Utilise <b>{ep2}</b>, <b>{ep3}</b> ou <b>{ep4}</b> pour forcer les zéros (ex: <b>01</b>, <b>001</b>,
                <b>0001</b>).
            </small>
            <input type="text" name="lien" class="form-control"
                value="<?php echo htmlspecialchars($item['lien'] ?? ''); ?>">
        </div>

        <div class="form-group row">
            <div class="col-half">
                <label for="saison" class="form-label">Saison</label>
                <input type="number" id="saison" name="saison" class="form-control"
                    value="<?php echo isset($item) ? esc($item['saison']) : ''; ?>">
            </div>
            <div class="col-half">
                <label for="episode" class="form-label">Épisode</label>
                <input type="text" id="episode" name="episode" class="form-control"
                    value="<?php echo isset($item) ? esc($item['episode']) : ''; ?>">
            </div>
        </div>


        <div class="form-actions">
            <a href="<?php echo base_url('/'); ?>" class="btn btn-cancel">Annuler</a>
            <button type="submit" class="btn btn-success">
                <?php echo isset($item) ? 'Enregistrer les modifications' : 'Créer la carte'; ?>
            </button>
        </div>
    </form>
</div>