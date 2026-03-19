<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Résultats de la campagne (ID: <?php echo esc_html($id_campaign); ?>)</h1>
    
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="?page=insset-campaigns" class="button">Retour aux campagnes</a>
        
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <input type="hidden" name="action" value="insset_export_csv">
            <input type="hidden" name="id_campaign" value="<?php echo esc_attr($id_campaign); ?>">
            
            <button type="submit" name="insset_export_btn" class="button button-primary">
                📥 Exporter les choix au format CSV
            </button>
        </form>
    </div>
    
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