<?php echo $this->extend('layout'); ?>
<?php echo $this->section('content'); ?>

<div class="container mt-5">
    <h2>Modifier l'utilisateur : <?php echo esc($user->username); ?></h2>

    <?php if (session()->has('errors')) { ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error) { ?>
            <li><?php echo esc($error); ?></li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>

    <form action="<?php echo base_url('users/update/'.$user->id); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" class="form-control"
                value="<?php echo esc($user->username); ?>" required>
        </div>

        <div class="mb-3">
            <label for="group" class="form-label">Rôle (Groupe)</label>
            <select name="group" id="group" class="form-select">
                <?php foreach ($availableGroups as $group => $info) { ?>
                <option value="<?php echo $group; ?>" <?php echo $user->inGroup($group) ? 'selected' : ''; ?>>
                    <?php echo esc($info['title'] ?? $group); ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <?php /* NOUVEAU BLOC : Réservé au superadmin */ ?>
        <?php if (auth()->user()->inGroup('superadmin')) { ?>
        <div class="mb-3">
            <label for="new_password" class="form-label">Nouveau mot de passe <small class="text-muted">(laisser vide
                    pour conserver l'actuel)</small></label>
            <div class="input-group">
                <input type="password" name="new_password" id="new_password" class="form-control"
                    autocomplete="new-password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    Afficher le mdp
                </button>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('new_password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    // Basculer le type entre 'password' et 'text'
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordInput.setAttribute('type', type);

                    // Modifier le texte du bouton en conséquence
                    this.textContent = type === 'password' ? 'Afficher' : 'Masquer';
                });
            }
        });
        </script>
        <?php } ?>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>

<?php echo $this->endSection(); ?>