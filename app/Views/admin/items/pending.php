<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<a href="<?php echo base_url('/'); ?>" class="btn btn-warning" style="margin-bottom: 20px;">Retour aux cartes</a>

<div class="container">
    <h2>Cartes en attente de validation</h2>
    <p>Ces cartes attendent votre feu vert pour apparaître dans l'espace public.</p>

    <?php if (session()->has('message')): ?>
    <div class="alert alert-success"><?php echo session('message'); ?></div>
    <?php endif ?>
    <?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?php echo session('error'); ?></div>
    <?php endif ?>

    <?php if (empty($pendingItems)): ?>
    <div class="empty-state">
        <p>🎉 Super, aucune carte n'est en attente d'inspection !</p>
    </div>
    <?php else: ?>
    <div class="admin-table-container fade-in">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre de l'œuvre</th>
                    <th>Description / Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingItems as $item): ?>
                <tr>
                    <td><strong><?= esc($item->titre) ?></strong></td>
                    <td><?= esc($item->description) ?></td>
                    <td>
                        <div class="action-links">
                            <a href="<?= base_url('item/form/' . $item->id) ?>" class="btn-action btn-edit">Examiner</a>
                            <a href="<?= base_url('items/approve/' . $item->id) ?>" class="btn-action"
                                style="background:var(--success); color:white;">Valider</a>
                            <a href="<?= base_url('items/reject/' . $item->id) ?>" class="btn-action btn-ban"
                                onclick="return confirm('Refuser cette carte ? Elle redeviendra privée.')">Refuser</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?php echo $this->endSection(); ?>