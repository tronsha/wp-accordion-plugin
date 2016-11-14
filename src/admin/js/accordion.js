jQuery(document).ready(function () {

    setDataPosition();

    jQuery('input[type="text"], textarea').bind('change keyup', function () {
        jQuery(window).bind('beforeunload', function () {
            return '';
        });
    });

    jQuery('input[type="submit"]').bind('click', function () {
        jQuery(window).unbind('beforeunload');
    });

    jQuery('[data-direction="down"]').bind('click', function () {
        moveDown(jQuery(this).parents('tr').data('position'));
    });

    jQuery('[data-direction="up"]').bind('click', function () {
        moveUp(jQuery(this).parents('tr').data('position'));
    });

});

function move(from, to) {
    var selectorHeadlineFrom = jQuery('[data-position="' + from + '"] [data-type="headline"]');
    var selectorHeadlineTo = jQuery('[data-position="' + to + '"] [data-type="headline"]');
    var selectorTextFrom = jQuery('[data-position="' + from + '"] [data-type="text"]');
    var selectorTextTo = jQuery('[data-position="' + to + '"] [data-type="text"]');
    var tmpHeadline = selectorHeadlineTo.val();
    var tmpText = selectorTextTo.val();
    selectorHeadlineTo.val(selectorHeadlineFrom.val());
    selectorTextTo.val(selectorTextFrom.val());
    selectorHeadlineFrom.val(tmpHeadline);
    selectorTextFrom.val(tmpText);
}

function moveUp(position) {
    move(position, position - 1);
}

function moveDown(position) {
    move(position, position + 1);
}

function setDataPosition() {
    var positionCounter = 0;
    jQuery('.accordion table.form-table tr').each(function () {
        jQuery(this).attr('data-position', positionCounter);
        positionCounter++;
    });
}
