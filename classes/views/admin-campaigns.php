<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Gestion des Campagnes ParcoursSup</h1>
    
    <hr class="wp-header-end">

    <div class="card" style="max-width: 100%; padding: 20px; margin-bottom: 20px;">
        <h2>Ajouter une nouvelle campagne</h2>
        <form method="post" action="">
            <?php wp_nonce_field('add_campaign_action', 'insset_campaign_nonce'); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="name_campaign">Nom de la campagne</label></th>
                    <td><input name="name_campaign" type="text" id="name_campaign" class="regular-text" required placeholder="Ex: Campagne 2025-2026"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="desc_campaign">Description</label></th>
                    <td><textarea name="desc_campaign" id="desc_campaign" rows="3" class="large-text"></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Dates (Début / Fin)</th>
                    <td>
                        <input name="start_date" type="date" required> au 
                        <input name="end_date" type="date" required>
                    </td>
                </tr>
            </table>
            
            <p class="submit">
                <input type="submit" name="insset_submit_campaign" id="submit" class="button button-primary" value="Enregistrer la campagne">
            </p>
        </form>
    </div>

    <table class="wp-list-table widefat fixed striped table-view-list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Dates</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($campaigns)) : ?>
                <?php foreach ($campaigns as $camp) : ?>
                    <tr>
                        <td><?php echo esc_html($camp->id_campaign); ?></td>
                        <td><strong><?php echo esc_html($camp->name_campaign); ?></strong></td>
                        <td><?php echo esc_html($camp->desc_campaign); ?></td>
                        <td>
                            Du <?php echo date('d/m/Y', strtotime($camp->startdate)); ?><br>
                            au <?php echo date('d/m/Y', strtotime($camp->end_date)); ?>
                        </td>
                        <td>
                            <?php echo ($camp->isactivated) ? '<span style="color:green; font-weight:bold;">Active</span>' : '<span style="color:red;">Fermée</span>'; ?>
                        </td>
                        <td>
                            <a href="?page=insset-campaigns&action=view_results&id=<?php echo $camp->id_campaign; ?>"><strong>Voir les résultats</strong></a> | 
                            <a href="#">Modifier</a> | 
                            <a href="#" style="color: #b32d2e;">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Aucune campagne trouvée. Créez-en une ci-dessus !</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>