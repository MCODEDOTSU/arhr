(function ($) {

    $(document).ready(function (e) {
        if ($('#mobile-menu').length !== 0) {
            $('#mobile-menu').mcodeMobileSidebar({
                openButtonSelector: '#mobile-panel .mobile-btn-open',
                closeButtonSelector: '#mobile-menu .mobile-btn-close',
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

        closeButtonSelector: '#mobile-menu-button-close',

    };

    let methods = {

        /**
         * Initialization
         * @param options
         */
        init: function (options) {

            let $sidebar = this;

            $sidebar.swipe({
                swipe: (event, direction, distance, duration, fingerCount, fingerData) => {
                    methods.hide.apply(this, [ $sidebar ]);
                },
                threshold: 50,
                fingers: 'all'
            });

            // $(document).swipe({
            //     swipeRight: (event, direction, distance, duration, fingerCount, fingerData) => {
            //         methods.show.apply(this, [ $sidebar ]);
            //     },
            //     threshold: 50,
            //     fingers: 'all'
            // });

            $(options.openButtonSelector).on('click', function () {
                methods.show.apply(this, [ $sidebar ]);
            });

            $(options.closeButtonSelector).on('click', function () {
                methods.hide.apply(this, [ $sidebar ]);
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