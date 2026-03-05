<?php

class InssetLoginShortcode {

    public static function render() {
        // Démarre la capture de l'affichage (indispensable pour les shortcodes WP)
        ob_start();

        // 1. TRAITEMENT DU FORMULAIRE DE CONNEXION
        $error_message = '';
        if (isset($_POST['insset_login_submit'])) {
            $ps_id = sanitize_text_field($_POST['ps_id']);
            $password = $_POST['ps_password'];

            // TODO : Plus tard, on appellera le CRUD pour vérifier l'étudiant dans la table insset_student.
            // Pour l'instant, on simule une connexion réussie avec des identifiants de test (test / test).
            if ($ps_id === 'test' && $password === 'test') {
                
                // On pourrait utiliser $_SESSION ou les cookies de WP. 
                // Pour l'exemple, on redirige vers une page "choix" (qu'on créera ensuite).
                wp_redirect(home_url('/choix/'));
                exit; // Toujours mettre un exit après une redirection !
            } else {
                $error_message = "Identifiant PS ou mot de passe incorrect.";
            }
        }

        // 2. CHARGEMENT DE LA VUE HTML
        require INSSET_DIR . 'classes/views/login-form.php';

        // Retourne le contenu capturé à WordPress pour l'afficher dans la page
        return ob_get_clean();
    }
}