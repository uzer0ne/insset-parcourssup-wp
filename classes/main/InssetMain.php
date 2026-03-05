<?php

class InssetMain {

    // Constructeur : c'est ici qu'on attache nos fonctions aux "hooks" de WordPress
    public function __construct() {
        
        // 1. Chargement des assets (CSS/JS) pour le Front-Office (côté étudiant)
        add_action('wp_enqueue_scripts', [$this, 'load_front_assets']);

        // 2. Chargement des assets pour le Back-Office (côté administration)
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);

        // Bientôt, on ajoutera ici les appels pour créer le menu d'administration
        // et les contrôleurs (actions) du projet.
    }

    /**
     * Charge les fichiers CSS et JS sur le site public
     */
    public function load_front_assets() {
        // Chargement du CSS (Rappel : ce fichier style.css sera généré par ton extension VS Code à partir de ton fichier LESS)
        wp_enqueue_style(
            'insset-front-style', 
            INSSET_URL . 'assets/css/style.css', 
            [], 
            '1.0'
        );

        // Chargement du JS avec jQuery en dépendance OBLIGATOIRE (exigence du projet)
        wp_enqueue_script(
            'insset-front-script', 
            INSSET_URL . 'assets/js/script.js', 
            ['jquery'], // <- C'est ici qu'on dit à WP de charger jQuery avant notre script !
            '1.0', 
            true // Charge le script dans le footer (bonne pratique)
        );
    }

    /**
     * Charge les fichiers CSS et JS dans l'administration de WordPress
     */
    public function load_admin_assets() {
        // On pourra créer un admin-style.css plus tard si besoin pour le back-office
    }
}