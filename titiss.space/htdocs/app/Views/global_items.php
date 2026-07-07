<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>
<?php
foreach ($items as $item) {
    echo '<div>';
    if ($item['id_user'] != 1) {
        echo '<h3 style="color: red;">' . esc($item['titre']) . '</h3>';
    } else {
        echo '<h3>' . esc($item['titre']) . '</h3>';
    }
    echo '</div>';
}
?>
</div>
<?php echo $this->endSection(); ?>