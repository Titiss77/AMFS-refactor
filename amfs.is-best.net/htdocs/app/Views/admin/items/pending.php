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
                    <th>Modifications apportées</th>
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
                        <?php if (!empty($revision['changes'])): ?>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <?php foreach ($revision['changes'] as $change): ?>
                            <li style="margin-bottom: 12px; border-bottom: 1px dashed #eee; padding-bottom: 8px;">
                                <strong style="color: #444; font-size: 0.9em;"><?= esc($change['label']) ?>
                                    :</strong><br>

                                <?php if ($change['field'] === 'image'): ?>
                                <div style="display: flex; gap: 15px; align-items: center; margin-top: 5px;">
                                    <div style="text-align: center;">
                                        <?php if (!empty($change['old'])): ?>
                                        <img src="<?= esc($change['old']) ?>" alt="Ancienne"
                                            style="max-height: 60px; border-radius: 4px; border: 1px solid #ddd; opacity: 0.5;">
                                        <?php else: ?>
                                        <span
                                            style="color: #dc3545; font-size: 0.85em; text-decoration: line-through;">Aucune</span>
                                        <?php endif; ?>
                                        <div style="font-size: 0.75em; color: #999;">Ancienne</div>
                                    </div>
                                    <span style="font-weight: bold; color: #aaa; font-size: 1.2em;">➔</span>
                                    <div style="text-align: center;">
                                        <?php if (!empty($change['new'])): ?>
                                        <img src="<?= esc($change['new']) ?>" alt="Nouvelle"
                                            style="max-height: 60px; border-radius: 4px; border: 2px solid var(--success, #28a745);">
                                        <?php else: ?>
                                        <span
                                            style="color: #28a745; font-weight: bold; font-size: 0.85em;">Supprimée</span>
                                        <?php endif; ?>
                                        <div style="font-size: 0.75em; color: #999;">Nouvelle</div>
                                    </div>
                                </div>
                                <?php else: ?>
                                <span
                                    style="color: #dc3545; text-decoration: line-through; font-size: 0.9em; background-color: #fdf2f2; padding: 1px 4px; border-radius: 3px;">
                                    <?= !empty($change['old']) ? esc($change['old']) : '<em>Vide</em>' ?>
                                </span>
                                <br>
                                <span
                                    style="color: #28a745; font-weight: bold; font-size: 0.95em; background-color: #f3faf4; padding: 1px 4px; border-radius: 3px; display: inline-block; margin-top: 2px;">
                                    ➔ <?= !empty($change['new']) ? esc($change['new']) : '<em>Vide</em>' ?>
                                </span>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <span style="color: #888; font-style: italic; font-size: 0.9em;">Aucun changement détecté sur
                            les valeurs.</span>
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