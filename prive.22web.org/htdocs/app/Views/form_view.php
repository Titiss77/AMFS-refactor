<?= $this->extend('l_global') ?>

<?= $this->section('contenu') ?>

<div class="form-wrapper">
    <div class="form-card">
        <div class="form-header">
            <h4><?= isset($lien) ? 'Modifier le lien' : 'Nouveau lien' ?></h4>
        </div>

        <div class="form-body">
            <form action="<?= base_url('sauvegarder') ?>" method="post">

                <input type="hidden" name="id" value="<?= isset($lien) ? $lien['id'] : '' ?>">

                <div class="form-group">
                    <label>Catégorie</label>
                    <select name="idCateg" required>
                        <option value="">Choisir une catégorie...</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"
                            <?= (isset($lien) && $lien['idCateg'] == $cat['id']) ? 'selected' : '' ?>>
                            <?= esc($cat['nom']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nom du lien</label>
                    <input type="text" name="nom" required value="<?= isset($lien) ? esc($lien['nom']) : '' ?>">
                </div>

                <div class="form-group">
                    <label>URL (Lien)</label>
                    <input type="url" name="lien" required value="<?= isset($lien) ? esc($lien['lien']) : '' ?>">
                </div>

                <div class="form-group">
                    <label>Temps estimé (ex: 5min)</label>
                    <input type="text" name="temps" maxlength="5"
                        value="<?= isset($lien) ? esc($lien['temps']) : '' ?>">
                </div>

                <div class="form-buttons">
                    <a href="<?= base_url('/') ?>" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-save">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>