jQuery(document).ready(function () {

    updateAccordionEditOutput();

    jQuery('body').on('change keyup', 'input[type="text"], textarea', function () {
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', 'input[type="submit"]', function () {
        unbindAccordionBeforeunload();
    });

    jQuery('body').on('click', '[data-direction="down"]', function () {
        moveAccordionDataDown(jQuery(this).parents('table').data('position'));
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', '[data-direction="up"]', function () {
        console.log('top');
        moveAccordionDataUp(jQuery(this).parents('table').data('position'));
        bindAccordionBeforeunload();
    });

    jQuery('#add_entries').bind('click', function () {
        addAccordionEntries();
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
    var selectorFormTable = jQuery('table.form-table:visible');
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

function addAccordionEntries() {
    var blank = jQuery('table.form-table:hidden').clone();
    var count = jQuery('table.form-table:visible').length;
    count += 1;
    blank.html(blank.html().replace('dummy', count)).css('display', '');
    blank.insertBefore(jQuery('#add_entries'));
    jQuery('#headline_dummy:visible').attr('id', 'headline_' + count);
    jQuery('[for="headline_dummy"]:visible').attr('for', 'headline_' + count);
    jQuery('#text_dummy:visible').attr('id', 'text_' + count);
    jQuery('[for="text_dummy"]:visible').attr('for', 'text_' + count);
    updateAccordionEditOutput();
}
