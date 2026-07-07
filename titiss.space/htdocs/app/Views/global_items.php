<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div style="margin-bottom: 2.5rem;">
    <h2>Cartes intéressantes</h2>
    <p style="color: var(--text-muted);">Voici les cartes publiques qui ne viennent pas de l'admin.</p>
</div>

<div class="cards-grid">
    <?php foreach ($items as $item): ?>
    <?php if ($item['id_user'] != 1): ?>
    <div class="card fade-in">
        <div class="card-body">
            <div class="card-link-block">
                <h3 class="card-title">
                    <?= esc($item['titre']) ?>
                </h3>
            </div>
            <?php } ?>
        </div>
        <div class="card-actions-bottom">
            <a href="<?= base_url('item/turn/' . esc($item['id'])) ?>" class="btn-icon btn-edit-sm">
                Passer en admin
            </a>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>