jQuery(document).ready(function($) {

    var updatePickers = function() {
        $('.colorful-categories-picker').wpColorPicker({
            change: _.throttle(function() {

                $(this).trigger('change');

                var msg = $(this).closest('.column-color').find('.colorful-categories-saving');
                msg.fadeIn();

                $.post(ajaxObject.ajaxUrl, {
                    action: 'update_color_options_array',
                    termId: $(this).data('term-id'),
                    taxonomy: $(this).data('taxonomy'),
                    color: $(this).val(),
                    colornonce: ajaxObject.colornonce
                }, function() {
                    msg.hide();
                });

            }, 2000)
        });
    };

    updatePickers();

    $('.wp-list-table').bind('DOMNodeInserted', function() {
        updatePickers();
    });
});