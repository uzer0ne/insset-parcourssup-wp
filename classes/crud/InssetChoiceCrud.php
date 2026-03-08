<?php

class InssetChoiceCrud {

    /**
     * Enregistre les choix d'un étudiant pour la campagne active
     */
    public static function save_choices($id_student, $choices_array) {
        global $wpdb;

        // 1. Trouver la campagne active
        $table_campaign = $wpdb->prefix . 'insset_campaign';
        $active_campaign = $wpdb->get_row("SELECT id_campaign FROM $table_campaign WHERE isactivated = 1 ORDER BY created_at DESC LIMIT 1");

        // S'il n'y a pas de campagne active, on bloque
        if (!$active_campaign) {
            return false;
        }
        $id_campaign = $active_campaign->id_campaign;

        // 2. Insérer la participation (student_to_campaign)
        $table_stc = $wpdb->prefix . 'insset_student_to_campaign';
        $id_stc = uniqid('stc_'); // On génère un ID unique car la table attend un VARCHAR(50)

        $inserted_stc = $wpdb->insert(
            $table_stc,
            [
                'id_student_to_campaign' => $id_stc,
                'id_student'             => $id_student,
                'id_campaign'            => $id_campaign,
                'status_candidate'       => 'valide',
                'date_add'               => current_time('mysql')
            ],
            ['%s', '%s', '%s', '%s', '%s']
        );

        if (!$inserted_stc) return false;

        // 3. Insérer les choix au format Entité/Valeur (student_choice)
        $table_choice = $wpdb->prefix . 'insset_student_choice';

        // La boucle permet l'extensibilité maximale demandée par le prof : 
        // Si demain on passe à 5 choix, ce code n'aura pas besoin d'être modifié !
        foreach ($choices_array as $order => $id_choice) {
            $id_sc = uniqid('sc_');
            
            $wpdb->insert(
                $table_choice,
                [
                    'id_student_choice'      => $id_sc,
                    'id_student_to_campaign' => $id_stc,
                    'id_choice'              => $id_choice,
                    'choice_order'           => $order, // L'ordre strict (1, 2 ou 3)
                    'created_at'             => current_time('mysql'),
                    'updated_at'             => current_time('mysql')
                ],
                ['%s', '%s', '%s', '%d', '%s', '%s']
            );
        }

        return true;
    }
}