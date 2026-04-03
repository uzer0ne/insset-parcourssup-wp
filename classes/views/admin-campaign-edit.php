<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Modifier la campagne</h1>
    
    <a href="?page=insset-campaigns" class="page-title-action">Retour aux campagnes</a>
    
    <hr class="wp-header-end">

    <div class="card" style="max-width: 100%; padding: 20px; margin-bottom: 20px;">
        <form method="post" action="">
            <?php wp_nonce_field('edit_campaign_action', 'insset_edit_nonce'); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="name_campaign">Nom de la campagne</label></th>
                    <td>
                        <input name="name_campaign" type="text" id="name_campaign" class="regular-text" required value="<?php echo esc_attr($campaign->name_campaign); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="desc_campaign">Description</label></th>
                    <td>
                        <textarea name="desc_campaign" id="desc_campaign" rows="3" class="large-text"><?php echo esc_textarea($campaign->desc_campaign); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Dates (Début / Fin)</th>
                    <td>
                        <input name="start_date" type="date" required value="<?php echo date('Y-m-d', strtotime($campaign->startdate)); ?>"> au 
                        <input name="end_date" type="date" required value="<?php echo date('Y-m-d', strtotime($campaign->end_date)); ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Statut</th>
                    <td>
                        <label>
                            <input type="checkbox" name="isactivated" value="1" <?php checked(1, $campaign->isactivated); ?>>
                            Campagne active (les étudiants peuvent s'y inscrire)
                        </label>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="insset_edit_campaign" class="button button-primary" value="Mettre à jour la campagne">
            </p>
        </form>
    </div>
</div>