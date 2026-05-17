<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<a href="<?php echo base_url('/'); ?>" class="btn btn-warning" style="margin-bottom: 20px;">Retour aux cartes</a>

<div class="container">
    <h2>Tableau de bord de Modération</h2>
    <p>Gérez les nouvelles publications et les propositions de modifications en attente.</p>

    <?php if (session()->has('message')): ?>
    <div class="alert alert-success"><?php echo session('message'); ?></div>
    <?php endif ?>
    <?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?php echo session('error'); ?></div>
    <?php endif ?>

    <?php if (empty($pendingItems) && empty($pendingRevisions)): ?>
    <div class="empty-state">
        <p>🎉 Super, aucune carte ni modification n'est en attente d'inspection !</p>
    </div>
    <?php else: ?>

    <?php if (!empty($pendingItems)): ?>
    <h3 style="margin-top: 30px; margin-bottom: 15px;">Nouvelles cartes en attente</h3>
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

    <?php if (!empty($pendingRevisions)): ?>
    <h3 style="margin-top: 40px; margin-bottom: 15px;">Modifications en attente</h3>
    <div class="admin-table-container fade-in">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Carte Originale</th>
                    <th>Nouvelles Informations (Aperçu)</th>
                    <th>Modifié par</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingRevisions as $revision): ?>
                <tr>
                    <td>
                        <strong><?= esc($revision['original_titre']) ?></strong><br>
                        <small style="color: #666;">ID Original: <?= esc($revision['original_item_id']) ?></small>
                    </td>
                    <td>
                        <strong>Nouveau titre :</strong> <?= esc($revision['titre']) ?><br>
                        <strong>Statut :</strong> <?= esc($revision['status']) ?><br>
                        <?php if(!empty($revision['description'])): ?>
                        <small><?= esc(word_limiter($revision['description'], 10)) ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span
                            style="background: var(--primary); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.85em;">
                            <?= esc($revision['author_name']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-links">
                            <a href="<?= base_url('items/approve-revision/' . $revision['id']) ?>" class="btn-action"
                                style="background:var(--success); color:white;"
                                onclick="return confirm('Approuver cette modification ? Elle écrasera la version publique actuelle.')">Approuver</a>
                            <a href="<?= base_url('items/reject-revision/' . $revision['id']) ?>"
                                class="btn-action btn-ban"
                                onclick="return confirm('Refuser cette modification ? Elle sera rejetée sans impacter la carte publique.')">Refuser</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <?php endif; ?>
</div>

<?php echo $this->endSection(); ?>