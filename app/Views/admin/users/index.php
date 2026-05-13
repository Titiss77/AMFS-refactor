<?php echo $this->extend('layout'); ?> <?php echo $this->section('content'); ?>
<a href="<?php echo base_url('/'); ?>" class="btn btn-warning">Retour aux cartes</a>
<div class="container mt-5">
    <h2>Gestion des Utilisateurs</h2>

    <?php if (session()->has('message')) { ?>
    <div class="alert alert-success"><?php echo session('message'); ?></div>
    <?php } ?>
    <?php if (session()->has('error')) { ?>
    <div class="alert alert-danger"><?php echo session('error'); ?></div>
    <?php } ?>

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
            <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo esc($user->username); ?></td>
                <td><?php echo esc($user->getIdentities()[0]->secret ?? 'N/A'); ?> </td>
                <td><?php echo implode(', ', $user->getGroups()); ?></td>
                <td>
                    <a href="<?php echo base_url('admin/users/edit/'.$user->id); ?>"
                        class="btn btn-sm btn-primary">Modifier</a>
                    <a href="<?php echo base_url('admin/users/delete/'.$user->id); ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->endSection(); ?>