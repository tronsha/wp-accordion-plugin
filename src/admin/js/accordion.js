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

    var selectorHeadlineFrom = jQuery('[data-position="' + from + '"] [data-type="headline"]');
    var selectorHeadlineTo = jQuery('[data-position="' + to + '"] [data-type="headline"]');
    var selectorTextFrom = jQuery('[data-position="' + from + '"] [data-type="text"]');
    var selectorTextTo = jQuery('[data-position="' + to + '"] [data-type="text"]');

    tmpHeadline = selectorHeadlineTo.val();
    tmpText = selectorTextTo.val();

    selectorHeadlineTo.val(selectorHeadlineFrom.val());
    selectorTextTo.val(selectorTextFrom.val());

    selectorHeadlineFrom.val(tmpHeadline);
    selectorTextFrom.val(tmpText);

}
