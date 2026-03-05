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
     * Supprime une campagne (avec vérification plus tard)
     */
    public static function delete($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_campaign';
        
        // TODO: Vérifier s'il y a des étudiants inscrits avant de supprimer (Règle métier)
        
        $wpdb->delete($table_name, ['id_campaign' => $id], ['%d']);
    }
}