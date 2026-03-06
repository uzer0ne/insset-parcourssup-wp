<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-register-box" style="max-width: 400px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: #f9f9f9;">
    <h2 style="text-align: center;">Créer un compte ParcoursSup</h2>
    
    <?php if (!empty($message)): ?>
        <div style="color: <?php echo ($message_type === 'success') ? 'green' : 'red'; ?>; margin-bottom: 15px; text-align: center; font-weight: bold;">
            <?php echo esc_html($message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Numéro PS (Identifiant)</label>
            <input type="text" name="ps_id" required style="width: 100%; padding: 8px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Nom</label>
            <input type="text" name="lname" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Prénom</label>
            <input type="text" name="fname" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Email</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Mot de passe</label>
            <input type="password" name="ps_password" required style="width: 100%; padding: 8px;">
        </div>

        <div style="text-align: center;">
            <button type="submit" name="insset_register_submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                S'inscrire
            </button>
        </div>
    </form>
</div>