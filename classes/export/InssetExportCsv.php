<?php

class InssetExportCsv {

    public static function generate_csv() {
        // 1. Sécurité : Vérifie que c'est bien un administrateur
        if (!current_user_can('manage_options')) {
            wp_die('Accès refusé.');
        }

        // 2. Récupération de l'ID envoyé par le formulaire POST
        if (!isset($_POST['id_campaign'])) {
            wp_die('ID de campagne manquant.');
        }
        $id_campaign = intval($_POST['id_campaign']);

        // 3. Récupération des données en base
        $raw_results = InssetChoiceCrud::get_results_by_campaign($id_campaign);

        // 4. On reformate comme on l'a fait pour le tableau
        $students_results = [];
        foreach ($raw_results as $row) {
            $nom_complet = $row->lname_student . ' ' . $row->fname_student;
            $students_results[$nom_complet][$row->choice_order] = $row->id_choice;
        }

        // Formations (à rendre dynamique plus tard si besoin)
        $formations = [
            '1' => 'BUT Informatique',
            '2' => 'BUT Metiers du Multimedia et de l\'Internet (MMI)',
            '3' => 'Licence Pro Developpement Web',
            '4' => 'Licence Pro E-commerce',
            '5' => 'Master Cloud Computing'
        ];

        // 5. Paramétrage du serveur pour forcer le téléchargement
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="export_parcourssup_campagne_' . $id_campaign . '.csv"');

        // 6. Ouverture du flux de sortie PHP (pour écrire le fichier)
        $output = fopen('php://output', 'w');

        // Ajout du BOM UTF-8 pour que Excel lise bien les accents français
        fputs($output, $bom =(chr(0xEF) . chr(0xBB) . chr(0xBF)));

        // Écriture de la première ligne (Les colonnes)
        fputcsv($output, ['Étudiant', 'Choix 1', 'Choix 2', 'Choix 3'], ';'); // On utilise le point-virgule pour Excel français

        // Écriture des données étudiant par étudiant
        if (!empty($students_results)) {
            foreach ($students_results as $student_name => $choices) {
                $ligne = [
                    $student_name,
                    isset($choices[1]) ? $formations[$choices[1]] : '',
                    isset($choices[2]) ? $formations[$choices[2]] : '',
                    isset($choices[3]) ? $formations[$choices[3]] : ''
                ];
                fputcsv($output, $ligne, ';');
            }
        } else {
            fputcsv($output, ['Aucun étudiant n\'a participé à cette campagne'], ';');
        }

        fclose($output);

        // 7. On arrête complètement l'exécution de WordPress (Sinon WP rajoute du code HTML à la fin du CSV)
        exit;
    }
}