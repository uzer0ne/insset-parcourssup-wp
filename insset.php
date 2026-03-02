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

// Initialisation basique pour tester que tout charge bien
// echo "";