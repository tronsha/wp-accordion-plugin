jQuery(document).ready(function () {

    updateOutput();

    jQuery('input[type="text"], textarea').bind('change keyup', function () {
        bindBeforeunload();
    });

    jQuery('input[type="submit"]').bind('click', function () {
        unbindBeforeunload();
    });

    jQuery('[data-direction="down"]').bind('click', function () {
        moveDown(jQuery(this).parents('table').data('position'));
        bindBeforeunload();
    });

    jQuery('[data-direction="up"]').bind('click', function () {
        moveUp(jQuery(this).parents('table').data('position'));
        bindBeforeunload();
    });

});

function bindBeforeunload() {
    jQuery(window).bind('beforeunload', function () {
        return '';
    });
}

function unbindBeforeunload() {
    jQuery(window).unbind('beforeunload');
}

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

function updateOutput() {
    var positionCounter = 1;
    var $formtable = jQuery('table.form-table');
    $formtable.each(function () {
        var $this = jQuery(this);
        $this.attr('data-position', positionCounter);
        if (positionCounter === 1) {
            $this.find('[data-direction="up"]').css('display', 'none');
        } else {
            $this.find('[data-direction="up"]').css('display', '');
        }
        if (positionCounter === $formtable.length) {
            $this.find('[data-direction="down"]').css('display', 'none');
        } else {
            $this.find('[data-direction="down"]').css('display', '');
        }
        positionCounter++;
    });
}
