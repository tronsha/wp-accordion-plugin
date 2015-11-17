jQuery(document).ready(function () {
    var $ = jQuery;
    $('.accordion').children('div').each(function () {
        $(this).css('height', '0');
    });
    $('.accordion').children('h2, h3, h4, h5, h6, strong').each(function () {
        var $this = $(this);
        if ('#' + $this.attr('id') == window.location.hash) {
            $this.prepend('<i class="fa fa-caret-down"></i>');
            $this.next('div').addClass('open').css('height', 'auto');
        } else {
            $this.prepend('<i class="fa fa-caret-right"></i>');
        }
        $this.bind('click', function () {
            location.href = '#' + $this.attr('id');
            setTimeout(function () {
                if ($this.length) {
                    $('html,body').animate({
                        scrollTop: ($this.offset().top - 40)
                    }, 1000);
                }
            }, 1000);
            var $div = $this.next('div');
            if ($div.hasClass('open') === false) {
                $(this).parent('.accordion').children('div.open').each(function () {
                    $(this).animate({height: 0}, 1000);
                    $(this).removeClass('open');
                });
                $(this).parent('.accordion').find('.fa-caret-down').each(function () {
                    $(this).removeClass('fa-caret-down').addClass('fa-caret-right');
                });
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.addClass('open');
                $div.animate({height: autoHeight}, 1000, function () {
                    $div.css('height', 'auto');
                });
                $this.find('.fa').removeClass('fa-caret-right').addClass('fa-caret-down');
            } else {
                $div.removeClass('open');
                $div.animate({height: 0}, 1000);
                $this.find('.fa').removeClass('fa-caret-down').addClass('fa-caret-right');
            }
        });
    });
});
