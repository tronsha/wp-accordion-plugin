jQuery(document).ready(function () {
    var $ = jQuery;
    $('.accordion').children('div').each(function () {
        $(this).css('height', '0');
    });
    $('.accordion').children('h2, h3, h4, h5, h6, strong').each(function () {
        var $this = $(this);
        $this.bind('click', function () {
            var $div = $this.next('div');
            if ($div.hasClass('open') === false) {
                $(this).parent('.accordion').children('div.open').each(function () {
                    $(this).animate({height: 0}, 1000);
                    $(this).removeClass('open');
                });
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.addClass('open');
                $div.animate({height: autoHeight}, 1000, function () {
                    $div.css('height', 'auto');
                });
            }
        });
    });
});
