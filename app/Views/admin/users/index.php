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

    <div class="admin-table-container fade-in">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr class="<?= $user->isBanned() ? 'user-banned' : '' ?>">

                    <td><?= esc($user->id) ?></td>
                    <td><strong><?= esc($user->username) ?></strong></td>

                    <td>
                        <?php if ($user->isBanned()): ?>
                        <span class="status-badge banned">Suspendu</span>
                        <?php else: ?>
                        <span class="status-badge active">Actif</span>
                        <?php endif ?>
                    </td>

                    <td>
                        <div class="action-links">
                            <a href="<?= base_url('users/edit/' . $user->id) ?>"
                                class="btn-action btn-edit">Modifier</a>

                            <?php if ($user->isBanned()): ?>
                            <a href="<?= base_url('users/unban/' . $user->id) ?>" class="btn-action btn-unban"
                                onclick="return confirm('Réhabiliter cet utilisateur ?')">Débannir</a>
                            <?php else: ?>
                            <a href="<?= base_url('users/delete/' . $user->id) ?>" class="btn-action btn-ban"
                                onclick="return confirm('Suspendre ce compte ?')">Bannir</a>
                            <?php endif ?>
                        </div>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $pager->links() ?>
</div>
<?php echo $this->endSection(); ?>