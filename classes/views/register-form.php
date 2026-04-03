<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-register-box">
    <h2>Créer un compte ParcoursSup</h2>
    
    <?php if (!empty($message)): ?>
        <div class="<?php echo ($message_type === 'success') ? 'insset-success' : 'insset-error'; ?>">
            <?php echo esc_html($message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div>
            <label>Numéro PS (Identifiant)</label>
            <input type="text" name="ps_id" required>
        </div>
        
        <div>
            <label>Nom</label>
            <input type="text" name="lname" required>
        </div>

        <div>
            <label>Prénom</label>
            <input type="text" name="fname" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Mot de passe</label>
            <input type="password" name="ps_password" required>
        </div>

        <div>
            <button type="submit" name="insset_register_submit">
                S'inscrire
            </button>
        </div>
    </form>
</div>