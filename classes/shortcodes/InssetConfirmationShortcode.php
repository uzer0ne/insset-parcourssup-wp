<?php

class InssetConfirmationShortcode {

    public static function render() {
        ob_start();

        // 1. VÉRIFICATION DE LA CONNEXION
        if (!isset($_SESSION['insset_student_id']) || empty($_SESSION['insset_student_id'])) {
            wp_redirect(home_url('/connexion/'));
            exit;
        }

        $id_student = $_SESSION['insset_student_id'];

        // 2. RÉCUPÉRATION DES DONNÉES EN BDD
        $saved_choices = InssetChoiceCrud::get_student_choices($id_student);

        // On remet notre tableau de formations en dur pour faire la correspondance avec les IDs
        // (Plus tard, on pourra les chercher dynamiquement dans la table wp_insset_choice)
        $formations = [
            '1' => 'BUT Informatique',
            '2' => 'BUT Métiers du Multimédia et de l\'Internet (MMI)',
            '3' => 'Licence Pro Développement Web',
            '4' => 'Licence Pro E-commerce',
            '5' => 'Master Cloud Computing'
        ];

        // 3. CHARGEMENT DE LA VUE HTML
        require INSSET_DIR . 'classes/views/confirmation.php';

        return ob_get_clean();
    }
}