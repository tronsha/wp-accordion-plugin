jQuery(document).ready(function () {

    updateAccordionEditOutput();

    jQuery('input[type="text"], textarea').bind('change keyup', function () {
        bindAccordionBeforeunload();
    });

    jQuery('input[type="submit"]').bind('click', function () {
        unbindAccordionBeforeunload();
    });

    jQuery('[data-direction="down"]').bind('click', function () {
        moveAccordionDataDown(jQuery(this).parents('table').data('position'));
        bindAccordionBeforeunload();
    });

    jQuery('[data-direction="up"]').bind('click', function () {
        moveAccordionDataUp(jQuery(this).parents('table').data('position'));
        bindAccordionBeforeunload();
    });

});

function bindAccordionBeforeunload() {
    jQuery(window).bind('beforeunload', function () {
        return '';
    });
}

function unbindAccordionBeforeunload() {
    jQuery(window).unbind('beforeunload');
}

function moveAccordionData(from, to) {
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

function moveAccordionDataUp(position) {
    moveAccordionData(position, position - 1);
}

function moveAccordionDataDown(position) {
    moveAccordionData(position, position + 1);
}

function updateAccordionEditOutput() {
    var positionCounter = 1;
    var selectorFormTable = jQuery('table.form-table');
    selectorFormTable.each(function () {
        var $this = jQuery(this);
        $this.attr('data-position', positionCounter);
        if (positionCounter === 1) {
            $this.find('[data-direction="up"]').css('display', 'none');
        } else {
            $this.find('[data-direction="up"]').css('display', '');
        }
        if (positionCounter === selectorFormTable.length) {
            $this.find('[data-direction="down"]').css('display', 'none');
        } else {
            $this.find('[data-direction="down"]').css('display', '');
        }
        positionCounter++;
    });
}
