<?php
// Sécurité : Empêche l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Gestion des Campagnes</h1>
    <a href="#" class="page-title-action">Ajouter une campagne</a>
    
    <hr class="wp-header-end">

    <table class="wp-list-table widefat fixed striped table-view-list">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la campagne</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><strong>Campagne 2025-2026</strong></td>
                <td><span style="color: green;">Active</span></td>
                <td>
                    <a href="#">Modifier</a> | <a href="#" style="color: red;">Supprimer</a>
                </td>
            </tr>
            </tbody>
    </table>
</div>