<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-login-box">
    <h2>Connexion ParcoursSup</h2>
    
    <?php if (!empty($error_message)): ?>
        <div class="insset-error">
            <?php echo esc_html($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div>
            <label for="ps_id">Numéro PS (Identifiant)</label>
            <input type="text" name="ps_id" id="ps_id" required>
        </div>

        <div>
            <label for="ps_password">Mot de passe</label>
            <input type="password" name="ps_password" id="ps_password" required>
        </div>

        <div>
            <button type="submit" name="insset_login_submit">
                Se connecter
            </button>
        </div>
    </form>
</div>