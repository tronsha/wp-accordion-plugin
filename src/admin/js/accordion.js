jQuery(document).ready(function () {

    jQuery('[data-direction="down"]').click(function() {
        var position = jQuery(this).parents('tr').data('position');
        move(position, position + 1);
    });

    jQuery('[data-direction="up"]').click(function() {
        var position = jQuery(this).parents('tr').data('position');
        move(position, position - 1);
    });

    jQuery('input[type="text"], textarea').bind('change keyup', function() {
        jQuery(window).bind('beforeunload', function () {
            return '';
        });
    });

    jQuery('input[type="submit"]').bind('click', function() {
        jQuery(window).unbind('beforeunload');
    });

});

function move(from, to) {

    var tmpHeadline, tmpText;

    tmpHeadline = jQuery('[data-position="' + to + '"] [data-type="headline"]').val();
    tmpText = jQuery('[data-position="' + to + '"] [data-type="text"]').val();

    jQuery('[data-position="' + to + '"] [data-type="headline"]').val(jQuery('[data-position="' + from + '"] [data-type="headline"]').val());
    jQuery('[data-position="' + to + '"] [data-type="text"]').val(jQuery('[data-position="' + from + '"] [data-type="text"]').val());

    jQuery('[data-position="' + from + '"] [data-type="headline"]').val(tmpHeadline);
    jQuery('[data-position="' + from + '"] [data-type="text"]').val(tmpText);

}
