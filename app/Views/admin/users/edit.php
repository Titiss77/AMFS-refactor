<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Modifier l'utilisateur : <?= esc($user->username) ?></h2>

    <form action="<?= base_url('admin/users/update/' . $user->id) ?>" method="post" class="mt-4">
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="group" class="form-label">Rôle (Groupe)</label>
            <select name="group" id="group" class="form-select" required>
                <?php foreach ($availableGroups as $groupAlias => $groupInfo) : ?>
                    <option value="<?= $groupAlias ?>" <?= $user->inGroup($groupAlias) ? 'selected' : '' ?>>
                        <?= esc($groupInfo['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<?= $this->endSection() ?>