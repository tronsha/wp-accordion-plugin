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
        $this.find('[data-direction="up"]').css('display', positionCounter === 1 ? 'none' : '');
        $this.find('[data-direction="down"]').css('display', positionCounter === selectorFormTable.length ? 'none' : '');
        $this.find('tr:nth-child(1) h2 > strong').text(positionCounter + '.)');
        $this.find('tr:nth-child(2) label').attr('for', 'headline_' + positionCounter);
        $this.find('tr:nth-child(2) input').attr('id', 'headline_' + positionCounter);
        $this.find('tr:nth-child(3) label').attr('for', 'text_' + positionCounter);
        $this.find('tr:nth-child(3) textarea').attr('id', 'text_' + positionCounter);
        positionCounter++;
    });
}

function addAccordionEntries() {
    jQuery('table.form-table:hidden').clone().css('display', '').insertBefore(jQuery('#add_entries'));
    updateAccordionEditOutput();
}
