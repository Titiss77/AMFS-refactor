<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<div class="container">
    <h2 style="color: var(--danger);">Alertes Liens Morts (Erreur 404)</h2>
    <p>Ces cartes possèdent des URL de visionnage identifiées comme rompues lors du dernier cycle de maintenance
        automatique.</p>

    <?php if (empty($deadItems)): ?>
    <div class="empty-state">
        <p>✅ Excellente nouvelle, tous les liens de streaming testés fonctionnent correctement !</p>
    </div>
    <?php else: ?>
    <div class="admin-table-container fade-in">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre de la carte</th>
                    <th>URL signalée cassée</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deadItems as $item): ?>
                <tr style="background-color: #fff8f8;">
                    <td><strong><?= esc($item['titre']) ?></strong></td>
                    <td
                        style="max-width: 400px; word-break: break-all; font-family: monospace; font-size: 0.85em; color: #dc3545;">
                        <?= esc($item['url_testee']) ?>
                    </td>
                    <td>
                        <div class="action-links">
                            <a href="<?= base_url('item/form/' . $item['item_id']) ?>"
                                class="btn-action btn-edit">Mettre à jour</a>
                            <a href="<?= esc($item['url_testee']) ?>" target="_blank" class="btn-action"
                                style="background: #6c757d; color: white;">Tester manuellement</a>
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