<?php

class InssetInstaller {

    public static function create_tables() {
        global $wpdb;

        // On charge la bibliothèque de WordPress qui contient dbDelta()
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // On récupère l'encodage par défaut de la base de données
        $charset_collate = $wpdb->get_charset_collate();

        // On définit le nom des tables avec le préfixe WP (ex: wp_insset_student)
        $t_student             = $wpdb->prefix . 'insset_student';
        $t_campaign            = $wpdb->prefix . 'insset_campaign';
        $t_choice              = $wpdb->prefix . 'insset_choice';
        $t_campaign_to_choice  = $wpdb->prefix . 'insset_campaign_to_choice';
        $t_student_to_campaign = $wpdb->prefix . 'insset_student_to_campaign';
        $t_student_choice      = $wpdb->prefix . 'insset_student_choice';

        /* * ATTENTION avec dbDelta : la syntaxe SQL doit être TRÈS stricte.
         * Par exemple, il faut 2 espaces entre PRIMARY KEY et la parenthèse.
         */

        // 1. Table Student
        $sql_student = "CREATE TABLE $t_student (
            id_student VARCHAR(50) NOT NULL,
            lname_student VARCHAR(50),
            fname_student VARCHAR(50),
            email_student VARCHAR(50),
            password VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            isactivated BOOLEAN DEFAULT 1,
            isarchived BOOLEAN DEFAULT 0,
            PRIMARY KEY  (id_student)
        ) $charset_collate;";

        // 2. Table Campaign
        $sql_campaign = "CREATE TABLE $t_campaign (
            id_campaign VARCHAR(50) NOT NULL,
            name_campaign VARCHAR(50),
            desc_campaign VARCHAR(300),
            startdate DATETIME,
            end_date DATETIME,
            isactivated BOOLEAN DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id_campaign)
        ) $charset_collate;";

        // 3. Table Choice (Formations)
        $sql_choice = "CREATE TABLE $t_choice (
            id_choice VARCHAR(50) NOT NULL,
            name_choice VARCHAR(125),
            desc_choice VARCHAR(300),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            isactivated BOOLEAN DEFAULT 1,
            isarchived BOOLEAN DEFAULT 0,
            PRIMARY KEY  (id_choice)
        ) $charset_collate;";

        // 4. Table Asso : Campaign to Choice
        $sql_campaign_to_choice = "CREATE TABLE $t_campaign_to_choice (
            id_campaign VARCHAR(50) NOT NULL,
            id_choice VARCHAR(50) NOT NULL,
            PRIMARY KEY  (id_campaign, id_choice),
            KEY id_campaign (id_campaign),
            KEY id_choice (id_choice)
        ) $charset_collate;";

        // 5. Table Asso : Student to Campaign
        $sql_student_to_campaign = "CREATE TABLE $t_student_to_campaign (
            id_student_to_campaign VARCHAR(50) NOT NULL,
            id_student VARCHAR(50) NOT NULL,
            id_campaign VARCHAR(50) NOT NULL,
            num_candidate INT,
            status_candidate VARCHAR(50),
            date_add DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id_student_to_campaign),
            KEY id_student (id_student),
            KEY id_campaign (id_campaign)
        ) $charset_collate;";

        // 6. Table Asso : Student Choice
        $sql_student_choice = "CREATE TABLE $t_student_choice (
            id_student_choice VARCHAR(50) NOT NULL,
            id_student_to_campaign VARCHAR(50) NOT NULL,
            id_choice VARCHAR(50) NOT NULL,
            choice_order INT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id_student_choice),
            KEY id_student_to_campaign (id_student_to_campaign),
            KEY id_choice (id_choice)
        ) $charset_collate;";

        // Exécution de la création des tables
        dbDelta($sql_student);
        dbDelta($sql_campaign);
        dbDelta($sql_choice);
        dbDelta($sql_campaign_to_choice);
        dbDelta($sql_student_to_campaign);
        dbDelta($sql_student_choice);
    }
}