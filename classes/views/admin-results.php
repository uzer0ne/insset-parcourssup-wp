<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Résultats de la campagne (ID: <?php echo esc_html($id_campaign); ?>)</h1>
    
    <a href="?page=insset-campaigns" class="page-title-action">Retour aux campagnes</a>
    
    <hr class="wp-header-end">

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>Choix 1</th>
                <th>Choix 2</th>
                <th>Choix 3</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students_results)) : ?>
                <?php foreach ($students_results as $student_name => $choices) : ?>
                    <tr>
                        <td><strong><?php echo esc_html($student_name); ?></strong></td>
                        <td><?php echo esc_html($formations[$choices[1] ?? ''] ?? '-'); ?></td>
                        <td><?php echo esc_html($formations[$choices[2] ?? ''] ?? '-'); ?></td>
                        <td><?php echo esc_html($formations[$choices[3] ?? ''] ?? '-'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucun étudiant n'a encore participé à cette campagne.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>