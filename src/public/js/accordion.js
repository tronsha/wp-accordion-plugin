jQuery(document).ready(function () {
    var $ = jQuery;
    var $accordion = $('.accordion');
    $accordion.removeClass('no-js');
    $accordion.children('h2, h3, h4, h5, h6, strong').each(function () {
        var $this = $(this);
        var $div = $this.next('div');
        if ('#' + $this.attr('data-hash') === window.location.hash || (true === $div.hasClass('open') && ('' === window.location.hash || '#!' === window.location.hash))) {
            $this.prepend('<span class="arrow-icons dashicons-arrow-down"></span>');
            $div.addClass('open').css('height', 'auto');
        } else {
            $this.prepend('<span class="arrow-icons dashicons-arrow-right"></span>');
            $div.removeClass('open').css('height', '0');
        }
        $this.on('click', function () {
            var $div = $this.next('div');
            if (false === $div.hasClass('open')) {
                if (undefined !== $this.attr('data-hash')) {
                    window.location.hash = $this.attr('data-hash');
                }
                $accordion.children('div.open').each(function () {
                    $(this).animate({height: 0}, 500);
                    $(this).removeClass('open');
                });
                $accordion.find('.dashicons-arrow-down').each(function () {
                    $(this).removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
                });
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.addClass('open');
                $div.animate({height: autoHeight}, 500, function () {
                    $div.css('height', 'auto');
                    if ($this.length && $accordion.hasClass('scroll')) {
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
                if (undefined !== $this.attr('data-hash')) {
                    window.location.hash = '!';
                }
                $div.removeClass('open');
                $div.animate({height: 0}, 500);
                $this.find('.arrow-icons').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
            }
        });
    });
});
