<?php if (!defined('ABSPATH')) exit; ?>

<div class="insset-choices-box">
    <h2>Vos choix de formations</h2>
    <p>Sélectionnez exactement 3 choix par ordre de préférence.</p>

    <?php if (!empty($error_message)): ?>
        <div class="insset-error">
            <?php echo esc_html($error_message); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="" id="insset-choices-form">
        
        <div>
            <label for="choix_1"><strong>Choix n°1 :</strong></label>
            <select name="choix_1" id="choix_1" class="insset-select-choice" required>
                <option value="">-- Sélectionnez votre premier choix --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="choix_2"><strong>Choix n°2 :</strong></label>
            <select name="choix_2" id="choix_2" class="insset-select-choice" required disabled>
                <option value="">-- Sélectionnez d'abord le choix n°1 --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="choix_3"><strong>Choix n°3 :</strong></label>
            <select name="choix_3" id="choix_3" class="insset-select-choice" required disabled>
                <option value="">-- Sélectionnez d'abord le choix n°2 --</option>
                <?php foreach ($formations as $id => $nom): ?>
                    <option value="<?php echo esc_attr($id); ?>"><?php echo esc_html($nom); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" name="insset_choices_submit" id="insset-submit-btn" disabled>
                Valider mes choix
            </button>
        </div>
    </form>
</div>