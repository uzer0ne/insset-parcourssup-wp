<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-confirmation-box">
    <h2>🎉 Félicitations !</h2>
    <p class="insset-success-msg">Vos choix de formations ont bien été enregistrés pour cette campagne.</p>
    
    <div class="insset-recap-box">
        <h3>Récapitulatif de vos vœux :</h3>
        
        <?php if (!empty($saved_choices)): ?>
            <ul>
                <?php foreach ($saved_choices as $choice): ?>
                    <li>
                        <strong>Vœu n°<?php echo esc_html($choice->choice_order); ?> :</strong> 
                        <?php echo esc_html($formations[$choice->id_choice] ?? 'Formation inconnue'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="insset-error">Aucun vœu n'a été trouvé.</p>
        <?php endif; ?>
    </div>

    <div class="insset-actions">
        <a href="<?php echo home_url(); ?>" class="insset-btn-secondary">Retour à l'accueil</a>
    </div>
</div>