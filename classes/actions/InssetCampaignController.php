<?php

class InssetCampaignController {

    public static function render_admin_page() {
        
        // --- NOUVEAU : INTERCEPTION DE L'AFFICHAGE DES RÉSULTATS ---
        if (isset($_GET['action']) && $_GET['action'] === 'view_results' && isset($_GET['id'])) {
            $id_campaign = intval($_GET['id']);
            
            // On récupère les résultats brut
            $raw_results = InssetChoiceCrud::get_results_by_campaign($id_campaign);
            
            // On reformate ça proprement en PHP (On regroupe par étudiant)
            $students_results = [];
            foreach ($raw_results as $row) {
                $nom_complet = $row->lname_student . ' ' . $row->fname_student;
                $students_results[$nom_complet][$row->choice_order] = $row->id_choice;
            }

            // Notre fameux tableau de correspondances (à rendre dynamique plus tard)
            $formations = [
                '1' => 'BUT Informatique',
                '2' => 'BUT Métiers du Multimédia et de l\'Internet (MMI)',
                '3' => 'Licence Pro Développement Web',
                '4' => 'Licence Pro E-commerce',
                '5' => 'Master Cloud Computing'
            ];

            // On charge la nouvelle vue des résultats et on ARRÊTE l'exécution ici
            require_once INSSET_DIR . 'classes/views/admin-results.php';
            return; 
        }
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