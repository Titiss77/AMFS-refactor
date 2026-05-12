<?= $this->extend('layout') ?> <?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Gestion des Utilisateurs</h2>

    <?php if (session()->has('message')) : ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle Actuel</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= esc($user->username) ?></td>
                    <td><?= esc($user->getIdentities()[0]->secret ?? 'N/A') ?> </td>
                    <td><?= implode(', ', $user->getGroups()) ?></td>
                    <td>
                        <a href="<?= base_url('admin/users/edit/' . $user->id) ?>" class="btn btn-sm btn-primary">Modifier</a>
                        <a href="<?= base_url('admin/users/delete/' . $user->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>