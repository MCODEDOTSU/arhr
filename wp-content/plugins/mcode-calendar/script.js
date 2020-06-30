(function ($) {
    $(document).ready(function () {
        $('.mcode-calendar').mcodeCalendar();
    });
})(jQuery);

(function ($) {

    let methods = {

        /**
         * Инициализация
         * @returns {*|void}
         * @param options
         */
        init: function (options) {

            let $calendar = this;

            /**
             * Btn init functions
             */
            $('.btn.prev', this).on('click', function () {
                methods.prev.apply($calendar);
            });

            $('.btn.next', this).on('click', function () {
                methods.next.apply($calendar);
            });

        },

        next: function () {
            let month = parseInt($('.i', this).data('month'), 10) + 1;
            let year = parseInt($('.i', this).data('year'), 10);
            methods.get.apply(this, [{
                month: (month > 12 ? 1 : month),
                year: (month > 12 ? year + 1 : year)
            }]);
        },

        prev: function () {
            let month = parseInt($('.i', this).data('month'), 10) - 1;
            let year = parseInt($('.i', this).data('year'), 10);
            methods.get.apply(this, [{
                month: (month < 1 ? 12 : month),
                year: (month < 1 ? year - 1 : year)
            }]);
        },

        get: function (options) {
            let $calendar = this;
            let data = {
                action: 'mcode_calendar_get',
                month: options.month,
                year: options.year,
                section: this.data('section'),
                field: this.data('field'),
            };
            $.post( ajax_object.ajax_url, data, function(json) {
                if(json.html) {
                    $calendar.html(json.html);
                    $calendar.mcodeCalendar();
                } else {
                    console.log(json.error);
                }
            }, 'json');
        },


    };

    $.fn.mcodeCalendar = function (options) {
        return methods.init.apply(this, arguments);
    };

})(jQuery);