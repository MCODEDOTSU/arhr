(function ($) {

    $(document).ready(function (e) {
        if ($('#mobile-menu').length !== 0) {
            $('#mobile-menu').mcodeMobileSidebar({
                openButtonSelector: '#mobile-panel .mobile-btn'
            });
        }
    });

})(jQuery);

/**
 * Мобильное меню
 */
(function ($) {

    let settings = {

        openButtonSelector: '#mobile-menu-button',

    };

    let methods = {

        /**
         * Initialization
         * @param options
         */
        init: function (options) {

            let $sidebar = this;

            let $closeButton = $('<button class="btn-close"></button>');
            $closeButton.on('click', function () {
                methods.hide.apply(this, [ $sidebar ]);
            });
            $sidebar.append($closeButton);

            $sidebar.swipe({
                swipe: (event, direction, distance, duration, fingerCount, fingerData) => {
                    methods.hide.apply(this, [ $sidebar ]);
                },
                threshold: 50,
                fingers: 'all'
            });

            $(document).swipe({
                swipeRight: (event, direction, distance, duration, fingerCount, fingerData) => {
                    methods.show.apply(this, [ $sidebar ]);
                },
                threshold: 50,
                fingers: 'all'
            });

            $(options.openButtonSelector).on('click', function () {
                methods.show.apply(this, [ $sidebar ]);
            });

        },

        show: function ($sidebar) {
            if ($(window).width() > 640) {
                return;
            }
            $sidebar.css('visibility', 'visible');
            $('body').addClass('noscroll');
            $sidebar.animate({
                opacity: 1
            });
        },

        hide: function ($sidebar) {
            if ($(window).width() > 640) {
                return;
            }
            $('body').removeClass('noscroll');
            $sidebar.animate({
                opacity: 0
            }, () => {
                $sidebar.css('visibility', 'hidden');
            });
        },

    };

    $.fn.mcodeMobileSidebar = function (options) {
        return methods.init.apply(this, [$.extend(settings, options)]);
    };

})(jQuery);