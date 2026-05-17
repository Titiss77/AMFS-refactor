<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h2>Journal d'Audit & Sécurité</h2>
    <p>Historique des actions récentes effectuées sur la plateforme.</p>

    <div class="admin-table-container fade-in" style="margin-top: 20px;">
        <table class="admin-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 12px; text-align: left;">Date & Heure</th>
                    <th style="padding: 12px; text-align: left;">Utilisateur</th>
                    <th style="padding: 12px; text-align: left;">Action</th>
                    <th style="padding: 12px; text-align: left;">Détails</th>
                    <th style="padding: 12px; text-align: left;">Adresse IP</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #6c757d;">Aucun historique
                        disponible.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($logs as $log): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px; font-size: 0.9em; color: #555;">
                        <?= date('d/m/Y H:i:s', strtotime($log['created_at'])) ?>
                    </td>
                    <td style="padding: 12px;">
                        <?php if ($log['username']): ?>
                        <span
                            style="background: var(--primary); color: white; padding: 3px 8px; border-radius: 4px; font-size: 0.85em;">
                            <?= esc($log['username']) ?>
                        </span>
                        <?php else: ?>
                        <span style="color: #999; font-style: italic;">Système / Invité</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 12px; font-weight: bold; color: #333;">
                        <?= esc($log['action']) ?>
                    </td>
                    <td style="padding: 12px; font-size: 0.9em; color: #666;">
                        <?= esc($log['details']) ?>
                    </td>
                    <td style="padding: 12px; font-size: 0.85em; font-family: monospace; color: #888;">
                        <?= esc($log['ip_address']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo $this->endSection(); ?>