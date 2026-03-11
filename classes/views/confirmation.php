<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-confirmation-box" style="max-width: 600px; margin: 20px auto; padding: 30px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; text-align: center;">
    <h2 style="color: #166534;">🎉 Félicitations !</h2>
    <p style="font-size: 1.1em; color: #15803d;">Vos choix de formations ont bien été enregistrés pour cette campagne.</p>
    
    <div style="margin-top: 25px; text-align: left; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0;">
        <h3 style="margin-top: 0;">Récapitulatif de vos vœux :</h3>
        
        <?php if (!empty($saved_choices)): ?>
            <ul style="list-style-type: none; padding: 0;">
                <?php foreach ($saved_choices as $choice): ?>
                    <li style="margin-bottom: 10px; font-size: 1.1em;">
                        <strong>Vœu n°<?php echo esc_html($choice->choice_order); ?> :</strong> 
                        <?php 
                            // On affiche le nom de la formation correspondant à l'ID
                            echo esc_html($formations[$choice->id_choice] ?? 'Formation inconnue'); 
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: red;">Aucun vœu n'a été trouvé.</p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 30px;">
        <a href="<?php echo home_url(); ?>" style="padding: 10px 20px; background: #64748b; color: white; text-decoration: none; border-radius: 4px;">Retour à l'accueil</a>
    </div>
</div>