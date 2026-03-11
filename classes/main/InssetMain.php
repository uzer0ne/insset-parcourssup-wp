<?php

class InssetMain {

    public function __construct() {
        
        // 1. Chargement des assets (CSS/JS) pour le Front-Office (côté étudiant)
        add_action('wp_enqueue_scripts', [$this, 'load_front_assets']);
        // 2. Chargement des assets pour le Back-Office (côté administration)
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_shortcode('insset_login', ['InssetLoginShortcode', 'render']);
        add_action('init', [$this, 'start_session']);
        add_shortcode('insset_login', ['InssetLoginShortcode', 'render']);
        add_shortcode('insset_register', ['InssetRegisterShortcode', 'render']);
        add_shortcode('insset_choices', ['InssetChoiceShortcode', 'render']);
        add_shortcode('insset_confirmation', ['InssetConfirmationShortcode', 'render']);
    }
    /**
     * NOUVEAU : Démarre la session si elle n'existe pas encore
     */
    public function start_session() {
        if (!session_id()) {
            session_start();
        }
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

    public function load_admin_assets() {
    }

    public function add_admin_menu() {
        // Ajoute un menu principal dans la barre latérale
        add_menu_page(
            'Gestion ParcoursSup',             // Titre de la page (onglet du navigateur)
            'ParcoursSup',                     // Titre dans le menu latéral
            'manage_options',                  // Droits requis (manage_options = Administrateur)
            'insset-campaigns',                // Identifiant unique (slug) de la page
            ['InssetCampaignController', 'render_admin_page'], // Le Contrôleur à appeler
            'dashicons-welcome-learn-more',    // Icône WordPress (petit chapeau d'étudiant)
            30                                 // Position dans le menu
        );
    }
}