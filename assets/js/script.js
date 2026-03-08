jQuery(document).ready(function($) {
    
    // On cible nos 3 listes déroulantes et le bouton
    var $choix1 = $('#choix_1');
    var $choix2 = $('#choix_2');
    var $choix3 = $('#choix_3');
    var $btnSubmit = $('#insset-submit-btn');

    // Fonction pour empêcher les doublons
    function updateOptions() {
        var val1 = $choix1.val();
        var val2 = $choix2.val();
        var val3 = $choix3.val();

        // On réactive toutes les options d'abord
        $('.insset-select-choice option').prop('disabled', false);

        // Si le choix 1 est rempli, on le grise dans le 2 et le 3
        if (val1) {
            $choix2.find('option[value="' + val1 + '"]').prop('disabled', true);
            $choix3.find('option[value="' + val1 + '"]').prop('disabled', true);
        }

        // Si le choix 2 est rempli, on le grise dans le 1 et le 3
        if (val2) {
            $choix1.find('option[value="' + val2 + '"]').prop('disabled', true);
            $choix3.find('option[value="' + val2 + '"]').prop('disabled', true);
        }

        // Si le choix 3 est rempli, on le grise dans le 1 et le 2
        if (val3) {
            $choix1.find('option[value="' + val3 + '"]').prop('disabled', true);
            $choix2.find('option[value="' + val3 + '"]').prop('disabled', true);
        }
    }

    // Événement : Quand le Choix 1 change
    $choix1.on('change', function() {
        if ($(this).val() !== '') {
            $choix2.prop('disabled', false); // On débloque le choix 2
            $choix2.find('option:first').text('-- Sélectionnez votre deuxième choix --');
        } else {
            // Si on remet à vide, on rebloque les suivants et on vide leurs valeurs
            $choix2.prop('disabled', true).val('');
            $choix3.prop('disabled', true).val('');
            $btnSubmit.prop('disabled', true).css('cursor', 'not-allowed');
        }
        updateOptions();
    });

    // Événement : Quand le Choix 2 change
    $choix2.on('change', function() {
        if ($(this).val() !== '') {
            $choix3.prop('disabled', false); // On débloque le choix 3
            $choix3.find('option:first').text('-- Sélectionnez votre troisième choix --');
        } else {
            $choix3.prop('disabled', true).val('');
            $btnSubmit.prop('disabled', true).css('cursor', 'not-allowed');
        }
        updateOptions();
    });

    // Événement : Quand le Choix 3 change
    $choix3.on('change', function() {
        if ($(this).val() !== '') {
            // Les 3 choix sont faits, on active le bouton de soumission !
            $btnSubmit.prop('disabled', false).css('cursor', 'pointer');
        } else {
            $btnSubmit.prop('disabled', true).css('cursor', 'not-allowed');
        }
        updateOptions();
    });

});