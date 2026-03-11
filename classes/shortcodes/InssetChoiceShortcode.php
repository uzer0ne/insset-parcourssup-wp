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
        $id_student = $_SESSION['insset_student_id'];

        // 2. VÉRIFICATION DU DOUBLE VOTE (NOUVEAU)
        if (InssetChoiceCrud::has_participated($id_student)) {
            // S'il a déjà voté, on le redirige de force vers le récapitulatif !
            wp_redirect(home_url('/confirmation/'));
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

            // Sécurité Back-end : On vérifie les doublons côté serveur
            if ($choix1 === $choix2 || $choix1 === $choix3 || $choix2 === $choix3) {
                $error_message = "Erreur : Vous avez sélectionné des formations en double.";
            } elseif (empty($choix1) || empty($choix2) || empty($choix3)) {
                $error_message = "Erreur : Vous devez remplir vos 3 choix dans l'ordre.";
            } else {
                
                // NOUVEAU : ENREGISTREMENT EN BASE DE DONNÉES
                $id_student = $_SESSION['insset_student_id'];
                
                // On prépare le tableau des choix avec leur ordre
                $mes_choix = [
                    1 => $choix1,
                    2 => $choix2,
                    3 => $choix3
                ];

                // Appel au Modèle (CRUD)
                $is_saved = InssetChoiceCrud::save_choices($id_student, $mes_choix);

                if ($is_saved) {
                    // Tout s'est bien passé, redirection vers la confirmation
                    wp_redirect(home_url('/confirmation/'));
                    exit;
                } else {
                    $error_message = "Erreur lors de l'enregistrement. Vérifiez qu'une campagne est bien active.";
                }
            }
        }

        // 3. CHARGEMENT DE LA VUE HTML
        require INSSET_DIR . 'classes/views/choices-form.php';

        return ob_get_clean();
    }
}