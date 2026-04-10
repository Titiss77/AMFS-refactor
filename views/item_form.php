<div
    style="max-width: 600px; margin: 0 auto; background: var(--fond-carte); padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

    <h2 style="margin-top: 0; color: var(--couleur-principale);">
        <?= isset($item) ? 'Modifier la carte' : 'Ajouter une nouvelle carte' ?>
    </h2>

    <form action="index.php?action=save" method="POST" style="display: flex; flex-direction: column; gap: 15px;">

        <?php if (isset($item)): ?>
        <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div>
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Titre :</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($item['titre'] ?? '') ?>" required
                style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;">
        </div>

        <div>
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Division :</label>
            <select name="id_division" required
                style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;">
                <?php foreach ($divisions as $div): ?>
                <option value="<?= $div['id'] ?>"
                    <?= (isset($item) && $item['id_division'] == $div['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($div['nom']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label style="font-weight: bold; display: block; margin-bottom: 2px;">Lien (URL) :</label>
            <small style="color: var(--texte-secondaire); display: block; margin-bottom: 5px; font-size: 12px;">
                💡 Astuce : <b>{s}</b> = saison, <b>{ep}</b> = épisode normal (1). <br>
                Utilise <b>{ep2}</b>, <b>{ep3}</b> ou <b>{ep4}</b> pour forcer les zéros (ex: <b>01</b>, <b>001</b>,
                <b>0001</b>).
            </small>
            <input type="text" name="lien" value="<?= htmlspecialchars($item['lien'] ?? '') ?>"
                style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 15px;">
            <div style="flex: 1;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Saison :</label>
                <input type="text" name="saison" value="<?= htmlspecialchars($item['saison'] ?? '1') ?>"
                    style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;">
            </div>
            <div style="flex: 1;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Épisode :</label>
                <input type="text" name="episode" value="<?= htmlspecialchars($item['episode'] ?? '1') ?>"
                    style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div>
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Description :</label>
            <textarea name="description" rows="3"
                style="width: 100%; padding: 8px; border: 1px solid var(--bordure); border-radius: 4px; box-sizing: border-box;"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 10px;">
            <a href="index.php"
                style="color: var(--danger); text-decoration: none; padding: 10px; border: 1px solid var(--danger); border-radius: 4px;">Annuler</a>
            <button type="submit"
                style="background-color: var(--couleur-principale); color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">Enregistrer</button>
        </div>
    </form>
</div>