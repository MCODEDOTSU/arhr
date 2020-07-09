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

            $('.month .btn.prev', this).on('click', function () {

                let month = parseInt($('.month', $calendar).data('item'), 10) - 1;
                let year = parseInt($('.year', $calendar).data('item'), 10);
                methods.get.apply($calendar, [{
                    month: (month < 1 ? 12 : month),
                    year: (month < 1 ? year - 1 : year)
                }]);

            });

            $('.month .btn.next', this).on('click', function () {

                let month = parseInt($('.month', $calendar).data('item'), 10) + 1;
                let year = parseInt($('.year', $calendar).data('item'), 10);
                methods.get.apply($calendar, [{
                    month: (month > 12 ? 1 : month),
                    year: (month > 12 ? year + 1 : year)
                }]);

            });

            $('.year .btn.prev', this).on('click', function () {

                let month = parseInt($('.month', $calendar).data('item'), 10);
                let year = parseInt($('.year', $calendar).data('item'), 10) - 1;
                methods.get.apply($calendar, [{
                    month: (month < 1 ? 12 : month),
                    year: (month < 1 ? year - 1 : year)
                }]);

            });

            $('.year .btn.next', this).on('click', function () {

                let month = parseInt($('.month', $calendar).data('item'), 10);
                let year = parseInt($('.year', $calendar).data('item'), 10) + 1;
                methods.get.apply($calendar, [{
                    month: (month > 12 ? 1 : month),
                    year: (month > 12 ? year + 1 : year)
                }]);

            });

            $('form', this).on('click', function () {
                $(this).submit();
            });

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