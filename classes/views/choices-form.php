<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-choices-box" style="max-width: 600px; margin: 20px auto; padding: 20px; background: #fff; border: 1px solid #ddd; border-radius: 8px;">
    <h2>Vos choix de formations</h2>
    <p>Sélectionnez exactement 3 choix par ordre de préférence.</p>

    <?php if (!empty($error_message)): ?>
        <div style="color: red; margin-bottom: 15px; font-weight: bold;">
            <?php echo esc_html($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" id="insset-choices-form">
        
        <div style="margin-bottom: 15px;">
            <label for="choix_1"><strong>Choix n°1 :</strong></label>
            <select name="choix_1" id="choix_1" class="insset-select-choice" required style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionnez votre premier choix --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="choix_2"><strong>Choix n°2 :</strong></label>
            <select name="choix_2" id="choix_2" class="insset-select-choice" required disabled style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionnez d'abord le choix n°1 --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="choix_3"><strong>Choix n°3 :</strong></label>
            <select name="choix_3" id="choix_3" class="insset-select-choice" required disabled style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionnez d'abord le choix n°2 --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" name="insset_choices_submit" id="insset-submit-btn" disabled style="padding: 10px 20px; background: #0073aa; color: white; border: none; cursor: not-allowed;">
                Valider mes choix
            </button>
        </div>
    </form>
</div>