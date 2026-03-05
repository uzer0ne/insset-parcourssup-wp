<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-login-box" style="max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: #f9f9f9;">
    <h2 style="text-align: center;">Connexion ParcoursSup</h2>
    
    <?php if (!empty($error_message)): ?>
        <div style="color: red; margin-bottom: 15px; text-align: center;">
            <?php echo esc_html($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div style="margin-bottom: 15px;">
            <label for="ps_id" style="display: block; margin-bottom: 5px;">Numéro PS (Identifiant)</label>
            <input type="text" name="ps_id" id="ps_id" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="ps_password" style="display: block; margin-bottom: 5px;">Mot de passe</label>
            <input type="password" name="ps_password" id="ps_password" required style="width: 100%; padding: 8px;">
        </div>

        <div style="text-align: center;">
            <button type="submit" name="insset_login_submit" style="padding: 10px 20px; background: #0073aa; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Se connecter
            </button>
        </div>
    </form>
</div>