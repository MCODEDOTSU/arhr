(function ($) {

    let settings = {
        itemSelector: '.item',
        margin: 0,
        speed: 0,
    };

    let methods = {

        /**
         * Инициализация
         * @returns {*|void}
         * @param options
         */
        init: function (options) {

            const $slider = this;

            $slider.css({
                'white-space': 'nowrap',
                'overflow': 'hidden',
            });

            $(options.itemSelector, this).eq(0).addClass('visibility');

            if (options.speed !== 0) {
                setTimeout(function () {
                    methods.next.apply($slider, [{
                        itemSelector: options.itemSelector,
                        speed: options.speed,
                    }]);
                }, options.speed);
            }

            let maxHeight = 0;
            $(options.itemSelector, this).each(function() {
                if ($(this).outerHeight() > maxHeight) {
                    maxHeight = $(this).outerHeight();
                }
            });
            this.height(maxHeight);
        },

        next: function (options) {

            const $slider = this;

            $current = $(`${options.itemSelector}.visibility`, this);
            $next = $(`${options.itemSelector}.visibility`, this).next();

            if ($next.length === 0) {
                $next = $(`${options.itemSelector}`, this).eq(0);
            }

            $current.animate({
                opacity: 0,
                visibility: 'hidden',
            }, 300, () => {
                $current.removeClass('visibility');
                $next.addClass('visibility');
                $current.hide();
                $next.show().animate({
                    opacity: 1,
                    visibility: 'visible',
                }, 300);

                if (options.speed !== 0) {
                    setTimeout(function () {
                        methods.next.apply($slider, [{
                            itemSelector: options.itemSelector,
                            speed: options.speed,
                        }]);
                    }, options.speed);
                }

            });

        },

        prev: function (options) {

        },

    };

    $.fn.mcodeSimpleSlider = function (options) {
        return methods.init.apply(this, [ $.extend( settings, options) ]);
    };

})(jQuery);