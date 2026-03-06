<?php

class InssetRegisterShortcode {

    public static function render() {
        ob_start();

        $message = '';
        $message_type = ''; // 'success' ou 'error'

        if (isset($_POST['insset_register_submit'])) {
            $ps_id = sanitize_text_field($_POST['ps_id']);
            $lname = sanitize_text_field($_POST['lname']);
            $fname = sanitize_text_field($_POST['fname']);
            $email = sanitize_email($_POST['email']);
            $password = $_POST['ps_password']; // On ne le sanitize pas car on va le hasher

            // 1. On vérifie si l'ID PS est déjà pris
            if (InssetStudentCrud::exists($ps_id)) {
                $message = "Ce numéro PS est déjà utilisé.";
                $message_type = "error";
            } else {
                // 2. On ajoute l'étudiant
                $inserted = InssetStudentCrud::add($ps_id, $lname, $fname, $email, $password);
                
                if ($inserted) {
                    $message = "Inscription réussie ! Vous pouvez maintenant vous connecter. sur la page acceuil parcoursup";
                    $message_type = "success";
                } else {
                    $message = "Une erreur est survenue lors de l'inscription.";
                    $message_type = "error";
                }
            }
        }

        // On charge la vue
        require INSSET_DIR . 'classes/views/register-form.php';

        return ob_get_clean();
    }
}