<?php

class InssetCampaignController {

    public static function render_admin_page() {
        
        // 1. TRAITEMENT DU FORMULAIRE (Si on a cliqué sur "Ajouter")
        if (isset($_POST['insset_submit_campaign'])) {
            // Vérification de sécurité (Nonce)
            if (!isset($_POST['insset_campaign_nonce']) || !wp_verify_nonce($_POST['insset_campaign_nonce'], 'add_campaign_action')) {
                die('Sécurité invalide');
            }

            // On appelle le CRUD pour ajouter
            InssetCampaignCrud::add(
                $_POST['name_campaign'],
                $_POST['desc_campaign'],
                $_POST['start_date'],
                $_POST['end_date']
            );

            // Petit message de succès (optionnel)
            echo '<div class="notice notice-success is-dismissible"><p>Campagne ajoutée avec succès !</p></div>';
        }

        // 2. RÉCUPÉRATION DES DONNÉES (READ)
        // On demande au Modèle la liste des campagnes à jour
        $campaigns = InssetCampaignCrud::get_all();

        // 3. CHARGEMENT DE LA VUE
        // On passe la variable $campaigns à la vue implicitement (elle sera disponible dans le fichier require)
        require_once INSSET_DIR . 'classes/views/admin-campaigns.php';
    }
}