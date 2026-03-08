<?php

class InssetChoiceShortcode {

    public static function render() {
        ob_start();

        // 1. VÉRIFICATION DE LA CONNEXION (Règle métier stricte)
        if (!isset($_SESSION['insset_student_id']) || empty($_SESSION['insset_student_id'])) {
            // Si non connecté, on le jette vers la page de connexion (Redirection 302)
            wp_redirect(home_url('/connexion/'));
            exit;
        }

        // Pour l'affichage, on simule quelques formations 
        // (Plus tard on les récupèrera avec un CRUD dans la table insset_choice)
        $formations = [
            '1' => 'BUT Informatique',
            '2' => 'BUT Métiers du Multimédia et de l\'Internet (MMI)',
            '3' => 'Licence Pro Développement Web',
            '4' => 'Licence Pro E-commerce',
            '5' => 'Master Master Cloud Computing'
        ];

        // 2. TRAITEMENT DU FORMULAIRE (Quand il clique sur Valider)
        if (isset($_POST['insset_choices_submit'])) {
            $choix1 = sanitize_text_field($_POST['choix_1']);
            $choix2 = sanitize_text_field($_POST['choix_2']);
            $choix3 = sanitize_text_field($_POST['choix_3']);

            // Sécurité Back-end : On vérifie les doublons côté serveur aussi !
            if ($choix1 === $choix2 || $choix1 === $choix3 || $choix2 === $choix3) {
                $error_message = "Erreur : Vous avez sélectionné des formations en double.";
            } elseif (empty($choix1) || empty($choix2) || empty($choix3)) {
                $error_message = "Erreur : Vous devez remplir vos 3 choix dans l'ordre.";
            } else {
                // Tout est bon ! (On fera l'INSERT en base de données à la prochaine étape)
                // Redirection vers la confirmation
                wp_redirect(home_url('/confirmation/'));
                exit;
            }
        }

        // 3. CHARGEMENT DE LA VUE HTML
        require INSSET_DIR . 'classes/views/choices-form.php';

        return ob_get_clean();
    }
}