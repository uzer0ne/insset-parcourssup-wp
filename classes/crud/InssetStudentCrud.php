<?php

class InssetStudentCrud {

    /**
     * Récupère un étudiant par son Identifiant PS
     */
    public static function get_by_id($id_student) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_student';
        
        // On prépare la requête pour éviter les failles SQL
        $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id_student = %s", $id_student);
        
        // get_row retourne une seule ligne (un seul étudiant)
        return $wpdb->get_row($query);
    }
    /**
     * NOUVEAU : Vérifie si un numéro PS existe déjà
     */
    public static function exists($id_student) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_student';
        $query = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE id_student = %s", $id_student);
        return $wpdb->get_var($query) > 0;
    }

    /**
     * NOUVEAU : Ajoute un nouvel étudiant
     */
    public static function add($id_student, $lname, $fname, $email, $password) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'insset_student';

        // HASHAGE DU MOT DE PASSE (Très important pour la sécurité !)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        return $wpdb->insert(
            $table_name,
            [
                'id_student'    => sanitize_text_field($id_student),
                'lname_student' => sanitize_text_field($lname),
                'fname_student' => sanitize_text_field($fname),
                'email_student' => sanitize_email($email),
                'password'      => $hashed_password, // On stocke le hash, pas le mot de passe en clair
                'isactivated'   => 1
            ],
            ['%s', '%s', '%s', '%s', '%s', '%d']
        );
    }
}