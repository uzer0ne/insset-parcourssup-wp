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

        // La boucle permet l'extensibilité maximale : 
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
    /**
     * Récupère les choix enregistrés d'un étudiant
     */
    public static function get_student_choices($id_student) {
        global $wpdb;
        $table_stc = $wpdb->prefix . 'insset_student_to_campaign';
        $table_sc  = $wpdb->prefix . 'insset_student_choice';

        // On fait une jointure (JOIN) entre la table de participation et la table des choix détaillés
        $query = $wpdb->prepare("
            SELECT sc.id_choice, sc.choice_order
            FROM $table_sc sc
            INNER JOIN $table_stc stc ON sc.id_student_to_campaign = stc.id_student_to_campaign
            WHERE stc.id_student = %s
            ORDER BY sc.choice_order ASC
        ", $id_student);

        return $wpdb->get_results($query);
    }
    /**
     * Vérifie si l'étudiant a déjà participé à la campagne active
     */
    public static function has_participated($id_student) {
        global $wpdb;
        $table_stc = $wpdb->prefix . 'insset_student_to_campaign';
        $table_campaign = $wpdb->prefix . 'insset_campaign';

        // On cherche s'il y a une ligne pour cet étudiant reliée à une campagne active
        $query = $wpdb->prepare("
            SELECT COUNT(*) 
            FROM $table_stc stc
            INNER JOIN $table_campaign c ON stc.id_campaign = c.id_campaign
            WHERE stc.id_student = %s AND c.isactivated = 1
        ", $id_student);

        return $wpdb->get_var($query) > 0;
    }

    /**
     * Récupère tous les choix de tous les étudiants pour UNE campagne précise
     */
    public static function get_results_by_campaign($id_campaign) {
        global $wpdb;
        $t_stc     = $wpdb->prefix . 'insset_student_to_campaign';
        $t_student = $wpdb->prefix . 'insset_student';
        $t_choice  = $wpdb->prefix . 'insset_student_choice';

        $query = $wpdb->prepare("
            SELECT st.lname_student, st.fname_student, sc.choice_order, sc.id_choice
            FROM $t_stc stc
            INNER JOIN $t_student st ON stc.id_student = st.id_student
            INNER JOIN $t_choice sc ON stc.id_student_to_campaign = sc.id_student_to_campaign
            WHERE stc.id_campaign = %d
            ORDER BY st.lname_student ASC, st.fname_student ASC, sc.choice_order ASC
        ", $id_campaign);

        return $wpdb->get_results($query);
    }
}