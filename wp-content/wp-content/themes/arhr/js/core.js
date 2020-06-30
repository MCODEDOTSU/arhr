(function ($) {

    $(document).ready(function (e) {
        searchformInit();
        $('#btn-up').mcodeBtnUp();
        // $('#menu-katalog-1').mcodeDropDownMenu({
        //     currentParentItemClass: 'current-menu-parent',
        //     defaultVisibilityItemClass: 'default-visibility'
        // });
        $('#mobile-sidebar').mcodeMobileSidebar();
    });

    function searchformInit() {
        jQuery('#searchform-container .btn-cross').click(() => {
            jQuery('#searchform-container').addClass('hidden');
        });
        jQuery('#searchform-show').click(() => {
            jQuery('#searchform-show').toggleClass('fa-search').toggleClass('fa-angle-right');
            if (jQuery('#searchform-show').hasClass('fa-search')) {
                jQuery('#searchform-container').addClass('hidden');
            } else {
                jQuery('#searchform-container').removeClass('hidden');
            }
        });
    }

})(jQuery);


(function ($) {
    let methods = {
        init: function (options) {
            let $btn = this;
            $btn.on('click', function () {
                $('html, body').animate({scrollTop: 0}, 500);
            });
            let $window = $(window);
            $window.on('load scroll', function () {
                if ($window.scrollTop() >= 300) $btn.show();
                else $btn.hide();
            });
        },
    };
    $.fn.mcodeBtnUp = function (options) {
        return methods.init.apply(this, arguments);
    };
})(jQuery);

(function ($) {

    let settings = {

        /**
         * Current Item Class
         */
        currentItemClass: 'current-item',

        /**
         * Current's Parent Item Class
         */
        currentParentItemClass: 'current-parent',

        /**
         * Items displayed by default in case there is no current item
         */
        defaultVisibilityItemClass: 'default-visibility',

        /**
         * Sub-menu Class
         */
        subMenuClass: 'sub-menu'

    };

    let methods = {

        /**
         * Initialization
         * @param options
         */
        init: function (options) {

            let $menu = this;
            $menu.addClass('mcode-drop-down');

            methods.display.apply(this, [$(`.${options.currentParentItemClass} > .${options.subMenuClass}`, $menu)]);
            if ($(`.${options.currentParentItemClass} > .${options.subMenuClass}`, $menu).length == 0) {
                methods.display.apply(this, [$(`.${options.defaultVisibilityItemClass} > .${options.subMenuClass}`, $menu)]);
            }

            $(`.${options.subMenuClass}`, $menu).each(function () {
                if ($(this).parent('li').hasClass('visibility')) {
                    $(this).parent('li').append(`<div class="fa fa-angle-up drop-down-button btn" title="Свернуть"></div>`);
                } else {
                    $(this).parent('li').append(`<div class="fa fa-angle-down drop-down-button btn" title="Развернуть"></div>`);
                }
            });

            $('.drop-down-button', $menu).click(function () {
                let $item = $(this).parent('li');
                if ($item.hasClass('visibility')) {
                    $(this).removeClass('fa-angle-up').addClass('fa-angle-down').attr('title', 'Развернуть');
                    methods.hide.apply(this, [$(`> .${options.subMenuClass}`, $item)]);
                } else {
                    $(this).removeClass('fa-angle-down').addClass('fa-angle-up').attr('title', 'Свернуть');
                    methods.display.apply(this, [$(`> .${options.subMenuClass}`, $item)]);
                }
            });

        },

        /**
         * Display sub-menu
         * @param $elements
         */
        display: function ($elements) {
            $elements.each(function () {
                let height = $(this).height('auto').height();
                $(this).height(0).animate({height}, 300);
                $(this).parent('li').addClass('visibility');
            });
        },

        /**
         * Hide sub-menu
         * @param $elements
         */
        hide: function ($elements) {
            $elements.each(function () {
                $(this).animate({height: 0}, 300);
                $(this).parent('li').removeClass('visibility');
            });
        }

    };

    $.fn.mcodeDropDownMenu = function (options) {
        return methods.init.apply(this, [ $.extend( settings, options) ]);
    };

})(jQuery);

(function ($) {

    let settings = {

        /**
         * Max width mobile device
         */
        mobileMaxWidth: 480,

    };

    let touch = {
        x: false,
        y: false
    };

    let temp = {
        x: false,
        y: false
    };

    let methods = {

        /**
         * Initialization
         * @param options
         */
        init: function (options) {

            let $sidebar = this;

            //Touch
            $(document).on('touchstart', (event) => {
                methods.touchstart.apply($sidebar, [{ event, mobileMaxWidth: options.mobileMaxWidth }]);
            });
            $(document).on('touchmove', (event) => {
                methods.touchmove.apply($sidebar, [{ event, mobileMaxWidth: options.mobileMaxWidth }]);
            });
            $(document).on('touchend', (event) => {
                methods.touchend.apply($sidebar, [{ event, mobileMaxWidth: options.mobileMaxWidth }]);
            });

            this.addClass('mcode-mobile-sidebar');

            this.wrapInner("<div class='container'></div>");
            $(".container", this).hide().css('opacity', 0);
            $(".sidebar", this).css('margin-left', -300);

            $btn = $("<div class='btn fa fa-bars'></div>");
            this.append($btn);
            $btn.on('click', () => {
                methods.display.apply(this);
            });

            $wrapper = $("<div class='wrapper'></div>");
            $wrapper.hide().css('opacity', 0);
            $(".container", this).append($wrapper);
            $wrapper.on('click', () => {
                methods.hide.apply(this);
            });

        },

        /**
         * Display sidebar
         */
        display: function() {
            $('html').css('overflow-y', 'hidden');
            $('.wrapper', this).show().animate({ opacity: 1 }, 200);
            $('.container', this).show().animate({ opacity: 1 }, 200);
            $(".sidebar", this).animate({ 'margin-left': 0 }, 300);
        },

        /**
         * Hide sidebar
         */
        hide: function() {
            $('html').css('overflow-y', 'scroll');
            $('.wrapper', this).animate({ opacity: 0 }, 200);
            $('.container', this).animate({ opacity: 0 }, 200);
            $('.sidebar', this).animate({ 'margin-left': -300 }, 300, () => {
                $('.wrapper', this).hide();
                $('.container', this).hide();
            });
        },

        /**
         * Touchstart
         */
        touchstart: function(attr) {

            if( $(document).width() > attr.mobileMaxWidth ||
                attr.event.originalEvent.touches === undefined ||
                attr.event.originalEvent.touches.length === 0 ) {
                return;
            }

            touch.x = attr.event.originalEvent.touches[0].pageX;
            touch.y = attr.event.originalEvent.touches[0].pageY;
            temp.x = touch.x;
            temp.y = touch.y;

        },

        /**
         * Touchmove
         */
        touchmove: function(attr) {

            if( $(document).width() > attr.mobileMaxWidth ||
                attr.event.originalEvent.touches === undefined ||
                attr.event.originalEvent.touches.length === 0 ) {
                return;
            }

            let x = attr.event.originalEvent.touches[0].pageX;
            let y = attr.event.originalEvent.touches[0].pageY;

            if( Math.abs(temp.x - x) <= 5 ||
                Math.abs(temp.y - y) > Math.abs(temp.x - x)) {
                return;
            }

            let $sidebar = this;

            if(x > touch.x) {
                methods.display.apply($sidebar);
            } else if(touch.x - x >= 10) {
                methods.hide.apply($sidebar);
            }

            temp.x = x;
            temp.y = y;

        },

        /**
         * Touchend
         */
        touchend: function (attr) {

            // if( $(document).width() > options.mobileMaxWidth) {
            //     return;
            // }
            //
            // var width = jQuery('#phone-menu').outerWidth();
            // var current = parseInt(jQuery('#phone-menu').attr('data-item'), 10);
            // var w = width + current;
            // if((width + current) <= width / 2) {
            //     if(current == (width * -1)) return;
            //     jQuery('#phone-menu').addClass('hidden');
            //     jQuery('#phone-menu').attr('data-item', (width * -1));
            //     jQuery('#phone-menu').animate({left: (width * -1) + 'px'}, 300 );
            //     jQuery('#phone-menu-back').hide().css('opacity', 0);
            // } else {
            //     if(current == 0) return;
            //     jQuery('#phone-menu').removeClass('hidden');
            //     jQuery('#phone-menu').attr('data-item', 0);
            //     jQuery('#phone-menu').animate({left: '0px'}, 300 );
            //     jQuery('#phone-menu-back').show().css('opacity', 1);
            // }


        },

    };

    $.fn.mcodeMobileSidebar = function (options) {
        return methods.init.apply(this, [ $.extend( settings, options) ]);
    };

})(jQuery);

