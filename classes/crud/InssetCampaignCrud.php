<?php

class InssetCampaignCrud {

    /**
     * Récupère toutes les campagnes
     */
    public static function get_all() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_campaign';
        
        // On récupère tout, trié par date de création (le plus récent en haut)
        return $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
    }

    /**
     * Ajoute une nouvelle campagne
     */
    public static function add($name, $desc, $start, $end) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_campaign';

        // Requête préparée (sécurité contre les injections SQL)
        $wpdb->insert(
            $table_name,
            [
                'name_campaign' => sanitize_text_field($name),
                'desc_campaign' => sanitize_textarea_field($desc),
                'startdate'     => $start,
                'end_date'      => $end,
                'isactivated'   => 1 // Active par défaut
            ],
            ['%s', '%s', '%s', '%s', '%d'] // Formats : string, string, string, string, int
        );
    }
    
    /**
     * Supprime une campagne (avec vérification de la règle métier)
     */
    public static function delete($id_campaign) {
        global $wpdb;
        
        // 1. RÈGLE MÉTIER : Vérifier s'il y a des participants
        $table_stc = $wpdb->prefix . 'insset_student_to_campaign';
        $query = $wpdb->prepare("SELECT COUNT(*) FROM $table_stc WHERE id_campaign = %d", $id_campaign);
        $participants_count = $wpdb->get_var($query);

        // Si au moins un étudiant a participé, on bloque la suppression !
        if ($participants_count > 0) {
            return false; 
        }

        // 2. Si c'est vide, on peut supprimer en toute sécurité
        $table_campaign = $wpdb->prefix . 'insset_campaign';
        $wpdb->delete($table_campaign, ['id_campaign' => $id_campaign], ['%d']);
        
        return true;
    }

    /**
     * Récupère une seule campagne par son ID
     */
    public static function get_by_id($id_campaign) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_campaign';
        
        $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id_campaign = %d", $id_campaign);
        return $wpdb->get_row($query);
    }

    /**
     * Met à jour une campagne existante
     */
    public static function update($id, $name, $desc, $start, $end, $isactivated) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_campaign';

        $wpdb->update(
            $table_name,
            [
                'name_campaign' => sanitize_text_field($name),
                'desc_campaign' => sanitize_textarea_field($desc),
                'startdate'     => $start,
                'end_date'      => $end,
                'isactivated'   => intval($isactivated)
            ],
            ['id_campaign' => $id], // La condition WHERE (quel ID modifier)
            ['%s', '%s', '%s', '%s', '%d'], // Les formats des données
            ['%d'] // Le format de l'ID
        );
    }
}