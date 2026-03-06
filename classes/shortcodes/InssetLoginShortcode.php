<?php

class InssetLoginShortcode {

    public static function render() {
        ob_start();

        $error_message = '';

        // 1. TRAITEMENT DU FORMULAIRE DE CONNEXION
        if (isset($_POST['insset_login_submit'])) {
            $ps_id = sanitize_text_field($_POST['ps_id']);
            $password = $_POST['ps_password'];

            // On va chercher l'étudiant en BDD
            $student = InssetStudentCrud::get_by_id($ps_id);

            // Si l'étudiant existe ET que le mot de passe correspond au hash en BDD
            if ($student && password_verify($password, $student->password)) {
                
                // Si le compte est désactivé
                if (!$student->isactivated) {
                    $error_message = "Votre compte est désactivé.";
                } else {
                    // C'est un succès ! On enregistre son ID dans la session
                    $_SESSION['insset_student_id'] = $student->id_student;
                    
                    // On redirige vers la future page de choix
                    wp_redirect(home_url('/choix/'));
                    exit;
                }
            } else {
                $error_message = "Identifiant PS ou mot de passe incorrect.";
            }
        }

        // 2. CHARGEMENT DE LA VUE HTML
        require INSSET_DIR . 'classes/views/login-form.php';

        return ob_get_clean();
    }
}