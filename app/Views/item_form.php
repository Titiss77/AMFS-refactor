<div>

    <h2>
        <?php echo isset($item) ? 'Modifier la carte' : 'Ajouter une nouvelle carte'; ?>
    </h2>

    <form action="<?php echo base_url('item/save'); ?>" method="POST">

        <?php if (isset($item)) { ?>
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <?php } ?>

        <div>
            <label>Titre :</label>
            <input type="text" name="titre" value="<?php echo htmlspecialchars($item['titre'] ?? ''); ?>" required>
        </div>

        <div>
            <label>Division :</label>
            <select name="id_division" required>
                <?php foreach ($divisions as $div) { ?>
                <option value="<?php echo $div['id']; ?>"
                    <?php echo (isset($item) && $item['id_division'] == $div['id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($div['nom']); ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div>
            <label>Lien (URL) :</label>
            <small>
                💡 Astuce : <b>{s}</b> = saison, <b>{ep}</b> = épisode normal (1). <br>
                Utilise <b>{ep2}</b>, <b>{ep3}</b> ou <b>{ep4}</b> pour forcer les zéros (ex: <b>01</b>, <b>001</b>,
                <b>0001</b>).
            </small>
            <input type="text" name="lien" value="<?php echo htmlspecialchars($item['lien'] ?? ''); ?>">
        </div>

        <div>
            <div>
                <label>Saison :</label>
                <input type="text" name="saison" value="<?php echo htmlspecialchars($item['saison'] ?? '1'); ?>">
            </div>
            <div>
                <label>Épisode :</label>
                <input type="text" name="episode" value="<?php echo htmlspecialchars($item['episode'] ?? '1'); ?>">
            </div>
        </div>

        <div>
            <label>Description :</label>
            <textarea name="description" rows="3"><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
        </div>

        <div>
            <a href="<?php echo base_url('/'); ?>">Annuler</a>
            <button type="submit">Enregistrer</button>
        </div>
    </form>
</div>