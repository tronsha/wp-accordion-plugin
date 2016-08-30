jQuery(document).ready(function () {
    var $ = jQuery;
    $('.accordion').children('div').each(function () {
        $(this).css('height', $(this).hasClass('open') === true ? 'auto' : '0');
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
            var $div = $this.next('div');
            if ($div.hasClass('open') === false) {
                if ($this.attr('id') != undefined) {
                    window.location.hash = $this.attr('id');
                }
                $(this).parent('.accordion').children('div.open').each(function () {
                    $(this).animate({height: 0}, 500);
                    $(this).removeClass('open');
                });
                $(this).parent('.accordion').find('.fa-caret-down').each(function () {
                    $(this).removeClass('fa-caret-down').addClass('fa-caret-right');
                });
                $div.css('height', 'auto');
                var autoHeight = $div.height();
                $div.css('height', '0');
                $div.addClass('open');
                $div.animate({height: autoHeight}, 500, function () {
                    $div.css('height', 'auto');
                    if ($this.length) {
                        $('html,body').animate({
                            scrollTop: ($this.offset().top - 6)
                        }, 250);
                    }
                });
                $this.find('.fa').removeClass('fa-caret-right').addClass('fa-caret-down');
            } else {
                if ($this.attr('id') != undefined) {
                    window.location.hash = '!';
                }
                $div.removeClass('open');
                $div.animate({height: 0}, 500);
                $this.find('.fa').removeClass('fa-caret-down').addClass('fa-caret-right');
            }
        });
    });
});
