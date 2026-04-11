<div class="form-container card">
    <h2 class="header-title">
        <?= isset($item) ? '✏️ Modifier la carte' : '+ Ajouter une carte' ?>
    </h2>

    <form action="<?= base_url('item/save') ?>" method="POST">
        <?= csrf_field() ?>

        <input type="hidden" name="id" value="<?= isset($item) ? esc($item['id']) : '' ?>">

        <div class="form-group">
            <label for="titre" class="form-label">Titre *</label>
            <input type="text" id="titre" name="titre" class="form-control"
                value="<?= isset($item) ? esc($item['titre']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="id_division" class="form-label">Division *</label>
            <select id="id_division" name="id_division" class="form-control" required>
                <?php if (!empty($divisions)) : ?>
                <?php foreach ($divisions as $div): ?>
                <option value="<?= esc($div['id']) ?>"
                    <?= (isset($item) && $item['id_division'] == $div['id']) ? 'selected' : '' ?>>
                    <?= esc($div['nom']) ?>
                </option>
                <?php endforeach; ?>
                <?php else: ?>
                <option value="">Aucune division disponible</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control"
                rows="4"><?= isset($item) ? esc($item['description']) : '' ?></textarea>
        </div>

        <div class="form-group row">
            <div class="col-half">
                <label for="saison" class="form-label">Saison</label>
                <input type="number" id="saison" name="saison" class="form-control"
                    value="<?= isset($item) ? esc($item['saison']) : '' ?>">
            </div>
            <div class="col-half">
                <label for="episode" class="form-label">Épisode</label>
                <input type="text" id="episode" name="episode" class="form-control"
                    value="<?= isset($item) ? esc($item['episode']) : '' ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="lien" class="form-label">Lien externe</label>
            <input type="url" id="lien" name="lien" class="form-control" placeholder="https://..."
                value="<?= isset($item) ? esc($item['lien']) : '' ?>">
        </div>

        <div class="form-actions">
            <a href="<?= base_url('/') ?>" class="btn btn-cancel">Annuler</a>
            <button type="submit" class="btn btn-success">
                <?= isset($item) ? 'Enregistrer les modifications' : 'Créer la carte' ?>
            </button>
        </div>
    </form>
</div>