(function ($) {

    let settings = {
        itemsSelector: '.items',
        itemSelector: '.item',
        margin: 0,
        speed: 0,
    };

    let isAuto = false;

    let methods = {

        /**
         * Инициализация
         * @returns {*|void}
         * @param options
         */
        init: function (options) {

            const $container = this;
            const $slider = $(options.itemsSelector, this);

            $slider.css({
                'white-space': 'nowrap',
                'overflow': 'hidden',
            });

            $(options.itemSelector, $slider).eq(0).addClass('visibility');
            methods.show.apply($slider, [{ item: $(options.itemSelector, $slider).eq(0) }]);

            if (options.speed !== 0) {
                isAuto = true;
                setTimeout(function () {
                    methods.auto.apply($slider, [{
                        itemSelector: options.itemSelector,
                        speed: options.speed,
                    }]);
                }, options.speed);
            }

            let maxHeight = 0;
            $(options.itemSelector, $slider).each(function() {
                if ($(this).outerHeight() > maxHeight) {
                    maxHeight = $(this).outerHeight();
                }
            });
            $slider.height(maxHeight);

            $('.arrow-left', $container).on('click', function () {
                isAuto = false;
                methods.prev.apply($slider, [{
                    itemSelector: options.itemSelector,
                    speed: options.speed,
                }]);
            });

            $('.arrow-right', $container).on('click', function () {
                isAuto = false;
                methods.next.apply($slider, [{
                    itemSelector: options.itemSelector,
                    speed: options.speed,
                }]);
            });

        },

        auto: function(options) {

            if (!isAuto) {
                return;
            }

            const $slider = this;

            methods.next.apply($slider, [{
                itemSelector: options.itemSelector,
                speed: options.speed,
            }]);

            setTimeout(function () {
                methods.auto.apply($slider, [{
                    itemSelector: options.itemSelector,
                    speed: options.speed,
                }]);
            }, options.speed);

        },

        next: function (options) {

            const $slider = this;

            $current = $(`${options.itemSelector}.visibility`, this);
            $next = $(`${options.itemSelector}.visibility`, this).next();

            if ($next.length === 0) {
                $next = $(`${options.itemSelector}`, this).eq(0);
            }

            $current.removeClass('visibility');
            $next.addClass('visibility');

            methods.hide.apply($slider, [{ item: $current }]);
            methods.show.apply($slider, [{ item: $next }]);

            if (options.speed !== 0 && isAuto === false) {
                setTimeout(function () {
                    isAuto = true;
                    methods.auto.apply($slider, [{
                        itemSelector: options.itemSelector,
                        speed: options.speed,
                    }]);
                }, options.speed);
            }

        },

        prev: function (options) {

            const $slider = this;

            $current = $(`${options.itemSelector}.visibility`, this);
            $prev = $(`${options.itemSelector}.visibility`, this).prev();

            if ($prev.length === 0) {
                $prev = $(`${options.itemSelector}`, this).last();
            }

            $current.removeClass('visibility');
            $prev.addClass('visibility');

            methods.hide.apply($slider, [{ item: $current }]);
            methods.show.apply($slider, [{ item: $prev }]);

            if (options.speed !== 0 && isAuto === false) {
                setTimeout(function () {
                    isAuto = true;
                    methods.auto.apply($slider, [{
                        itemSelector: options.itemSelector,
                        speed: options.speed,
                    }]);
                }, options.speed);
            }

        },

        show: function (options) {
            options.item.show();
            options.item.animate({
                opacity: 1,
            }, 500);
        },

        hide: function (options) {
            options.item.animate({
                opacity: 0,
            }, 500, () => {
                options.item.hide();
            });
        },

    };

    $.fn.mcodeSimpleSlider = function (options) {
        return methods.init.apply(this, [ $.extend( settings, options) ]);
    };

})(jQuery);