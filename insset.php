<?php
/**
 * Plugin Name: Projet INSSET - ParcoursSup
 * Description: Application inspirée du fonctionnement de ParcoursSup (LP 2025-2026).
 * Version: 1.0
 * Author: YARA
 */

// Sécurité : Empêche l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Définition des constantes pour les chemins
define('INSSET_DIR', plugin_dir_path(__FILE__));
define('INSSET_URL', plugin_dir_url(__FILE__));

// Autoloader basique pour charger automatiquement tes classes
spl_autoload_register(function ($class_name) {
    $directories = [
        'classes/actions/',
        'classes/cron/',
        'classes/crud/',
        'classes/export/',
        'classes/helpers/',
        'classes/install/',
        'classes/main/',
        'classes/shortcodes/',
        'classes/views/',
        'classes/widget/'
    ];

    foreach ($directories as $directory) {
        $file = INSSET_DIR . $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Démarrage du plugin une fois que WordPress a chargé tous les plugins
add_action('plugins_loaded', 'insset_start_plugin');

function insset_start_plugin() {
    // On instancie la classe principale qui va tout orchestrer
    $insset_main = new InssetMain();
}

// Hook d'activation : lancer la création des tables
register_activation_hook(__FILE__, 'insset_activate_plugin');

function insset_activate_plugin() {
    // On met à jour le nom du fichier à charger
    require_once INSSET_DIR . 'classes/install/InssetInstaller.php';
    
    // On appelle la méthode sur la nouvelle classe préfixée
    InssetInstaller::create_tables();
}
