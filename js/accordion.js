jQuery(document).ready(function () {
    var $ = jQuery;
    var open = true;
    $('.accordion').child('h2, h3, h4, h5, h6, strong').each(function () {
        var $this = $(this);
        $this.bind('click', function () {
            var $div = $this.next('div');
            if ($div.css('height') == '0px') {
                if (open) {
                    $(this).parent('.accordion').child('div').each(function () {
                        $(this).animate({height: 0}, 1000);
                    });
                }
                open = true;
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.animate({height: autoHeight}, 1000, function () {
                    $div.css('height', 'auto');
                });
            }
        });
    });
});
