jQuery(document).ready(function () {
    var $ = jQuery;
    $('.accordion').children('div').each(function () {
        $(this).css('height', $(this).hasClass('open') === true ? 'auto' : '0');
    });
    $('.accordion').children('h2, h3, h4, h5, h6, strong').each(function () {
        var $this = $(this);
        if ('#' + $this.attr('data-hash') == window.location.hash) {
            $this.prepend('<span class="arrow-icons dashicons-arrow-down"></span>');
            $this.next('div').addClass('open').css('height', 'auto');
        } else {
            $this.prepend('<span class="arrow-icons dashicons-arrow-right"></span>');
        }
        $this.bind('click', function () {
            var $div = $this.next('div');
            if ($div.hasClass('open') === false) {
                if ($this.attr('data-hash') != undefined) {
                    window.location.hash = $this.attr('data-hash');
                }
                $(this).parent('.accordion').children('div.open').each(function () {
                    $(this).animate({height: 0}, 500);
                    $(this).removeClass('open');
                });
                $(this).parent('.accordion').find('.dashicons-arrow-down').each(function () {
                    $(this).removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
                });
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.addClass('open');
                $div.animate({height: autoHeight}, 500, function () {
                    $div.css('height', 'auto');
                    if ($this.length && $('.accordion').hasClass('scroll')) {
                        var margintop = 6;
                        if ($('#wpadminbar').length) {
                            margintop += parseInt($('html').css('margin-top'));
                        }
                        $('html,body').animate({
                            scrollTop: ($this.offset().top - margintop)
                        }, 250);
                    }
                });
                $this.find('.arrow-icons').removeClass('dashicons-arrow-right').addClass('dashicons-arrow-down');
            } else {
                if ($this.attr('data-hash') != undefined) {
                    window.location.hash = '!';
                }
                $div.removeClass('open');
                $div.animate({height: 0}, 500);
                $this.find('.arrow-icons').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
            }
        });
    });
});
