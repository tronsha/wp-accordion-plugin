jQuery(document).ready(function () {

    updateAccordionEdit();

    jQuery('body').on('click', '.accordion-edit [data-button="add"]', function () {
        jQuery('table.form-table.accordion-entry:hidden').clone().css('display', '').insertBefore(jQuery('[data-button="add"]'));
        updateAccordionEdit();
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', '.accordion-edit [data-button="delete"]', function () {
        jQuery(this).parents('table').remove();
        updateAccordionEdit();
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', '.accordion-edit [data-button="down"]', function () {
        moveAccordionDataDown(parseInt(jQuery(this).parents('table').attr('data-position')));
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', '.accordion-edit [data-button="up"]', function () {
        moveAccordionDataUp(parseInt(jQuery(this).parents('table').attr('data-position')));
        bindAccordionBeforeunload();
    });

    jQuery('body').on('change keyup', '.accordion-edit input[type="text"], .accordion-edit textarea', function () {
        bindAccordionBeforeunload();
    });

    jQuery('body').on('click', '.accordion-edit input[type="submit"]', function () {
        unbindAccordionBeforeunload();
    });

});

function updateAccordionEdit() {
    var positionCounter = 1;
    var selectorFormTable = jQuery('table.form-table.accordion-entry:visible');
    selectorFormTable.each(function () {
        var $this = jQuery(this);
        $this.attr('data-position', positionCounter);
        $this.find('[data-button="up"]').css('display', positionCounter === 1 ? 'none' : '');
        $this.find('[data-button="down"]').css('display', positionCounter === selectorFormTable.length ? 'none' : '');
        $this.find('tr:nth-child(1) h2 > strong').text(positionCounter + '.)');
        $this.find('tr:nth-child(2) label').attr('for', 'headline_' + positionCounter);
        $this.find('tr:nth-child(2) input').attr('id', 'headline_' + positionCounter);
        $this.find('tr:nth-child(3) label').attr('for', 'text_' + positionCounter);
        $this.find('tr:nth-child(3) textarea').attr('id', 'text_' + positionCounter);
        positionCounter++;
    });
}

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
