<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<div class="actions-container">
    <a href="<?php echo base_url('/'); ?>" class="btn btn-cancel">← Retour aux cartes</a>
</div>

<div class="container">
    <h2 style="margin-bottom: 2rem;">Gestion des Utilisateurs</h2>

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
                <?php foreach ($users as $user) { ?>
                <tr class="<?php echo $user->isBanned() ? 'user-banned' : ''; ?>">

                    <td><?php echo esc($user->id); ?></td>
                    <td><strong><?php echo esc($user->username); ?></strong></td>

                    <td>
                        <?php if ($user->isBanned()) { ?>
                        <span class="status-badge banned">Suspendu</span>
                        <?php } else { ?>
                        <span class="status-badge active">Actif</span>
                        <?php } ?>
                    </td>

                    <td>
                        <div class="action-links">
                            <a href="<?php echo base_url('users/edit/'.$user->id); ?>"
                                class="btn-action btn-edit">Modifier</a>

                            <?php if ($user->isBanned()) { ?>
                            <a href="<?php echo base_url('users/unban/'.$user->id); ?>" class="btn-action btn-unban"
                                onclick="return confirm('Réhabiliter cet utilisateur ?')">Débannir</a>
                            <?php } else { ?>
                            <a href="<?php echo base_url('users/delete/'.$user->id); ?>" class="btn-action btn-ban"
                                onclick="return confirm('Suspendre ce compte ?')">Bannir</a>
                            <?php } ?>
                        </div>
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div style="display:flex; justify-content:center;">
        <?php echo $pager->links(); ?>
    </div>
</div>

<?php echo $this->endSection(); ?>