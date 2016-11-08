jQuery(document).ready(function () {

    jQuery('[data-move="down"]').click(function() {
        var position = jQuery(this).data('position');
        move(position, position + 1);
    });

    jQuery('[data-move="up"]').click(function() {
        var position = jQuery(this).data('position');
        move(position, position - 1);
    });

});

function move(from, to) {

    var tmpHeadline, tmpText;

    tmpHeadline = jQuery('[data-type="headline"][data-position="' + to + '"]').val();
    tmpText = jQuery('[data-type="text"][data-position="' + to + '"]').val();

    jQuery('[data-type="headline"][data-position="' + to + '"]').val(jQuery('[data-type="headline"][data-position="' + from + '"]').val());
    jQuery('[data-type="text"][data-position="' + to + '"]').val(jQuery('[data-type="text"][data-position="' + from + '"]').val());

    jQuery('[data-type="headline"][data-position="' + from + '"]').val(tmpHeadline);
    jQuery('[data-type="text"][data-position="' + from + '"]').val(tmpText);

}
