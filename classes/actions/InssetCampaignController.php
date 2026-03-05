<?php

class InssetCampaignController {

    /**
     * Méthode appelée pour afficher la page d'administration des campagnes
     */
    public static function render_admin_page() {
        // Plus tard, on appellera le CRUD ici pour récupérer les campagnes en base de données.
        // Pour l'instant, on se contente de charger la vue (le HTML).
        
        // On inclut le fichier de vue
        require_once INSSET_DIR . 'classes/views/admin-campaigns.php';
    }
}