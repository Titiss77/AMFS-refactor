<?= $this->extend('l_global') ?>

<?= $this->section('contenu') ?>

<?php if (session()->getFlashdata('message')): ?>
<div class="flash-message success">
    <?= session()->getFlashdata('message') ?>
</div>
<?php endif; ?>

<div class="page-header">
    <div class="header-titles">
        <h1>Mes Favoris</h1>
        <p>Sommaire des ressources</p>
    </div>
    <a href="<?= base_url('ajouter') ?>" class="btn-main">
        + Nouveau Lien
    </a>
</div>

<?php if (!empty($sommaire)): ?>

<div class="categories-container">
    <?php foreach ($sommaire as $groupe): ?>

    <div class="category-block accordion-item">

        <div class="category-header js-accordion-trigger">
            <h3><?= esc($groupe['info_categorie']['nom']) ?></h3>
            <span class="accordion-icon">▼</span>
        </div>

        <div class="category-content">
            <?php if (!empty($groupe['liens'])): ?>
            <ul class="links-list">
                <?php foreach ($groupe['liens'] as $lien): ?>
                <li class="link-item">

                    <a href="<?= esc($lien['lien']) ?>" target="_blank" class="link-main">
                        <span class="link-title"><?= esc($lien['nom']) ?></span>
                        <span class="link-url"><?= esc($lien['lien']) ?></span>
                    </a>

                    <div class="link-actions">
                        <?php if (!empty($lien['temps'])): ?>
                        <span class="tag-time">⏱ <?= esc($lien['temps']) ?></span>
                        <?php endif; ?>

                        <div class="action-buttons-group">
                            <a href="<?= base_url('modifier/' . $lien['id']) ?>" class="btn-icon edit">
                                ✏️
                            </a>

                            <a href="<?= base_url('supprimer/' . $lien['id']) ?>" class="btn-icon delete"
                                onclick="return confirm('Êtes-vous sûr ?');">
                                🗑️
                            </a>
                        </div>
                    </div>

                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p class="empty-msg">Aucun lien dans cette catégorie.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php endforeach; ?>
</div>

<?php else: ?>
<div class="flash-message warning">
    Aucune catégorie trouvée.
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const headers = document.querySelectorAll('.js-accordion-trigger');

    headers.forEach(header => {
        header.addEventListener('click', function() {
            // On trouve le parent (.category-block)
            const parent = this.closest('.category-block');

            // On bascule la classe 'is-open'
            parent.classList.toggle('is-open');
        });
    });
});
</script>

<?= $this->endSection() ?>