(function ($) {

    $(document).ready(function () {

        $('.mcode_calendar-full').mcodeCalendar();

        $('table.calendar-grid form').on('click', function () {
            $(this).submit();
        });

        $('.mcode_calendar-days_month .tab').on('click', function (event) {
            $('.mcode_calendar-days_month .tab-content.visibility').removeClass('visibility');
            $(`.mcode_calendar-days_month .tab-content[data-name="${$(this).attr('href')}"]`).addClass('visibility');
            $('.mcode_calendar-days_month .tab.current').removeClass('current');
            $(`.mcode_calendar-days_month .tab[href="${$(this).attr('href')}"]`).addClass('current');
            event.preventDefault();
        });

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

        },

        get: function (options) {
            let $calendar = this;
            let data = {
                action: 'mcode_calendar_get',
                month: options.month,
                year: options.year,
            };
            $.post( ajax_object.ajax_url, data, function(json) {

                if(json.html) {
                    $calendar.html(json.html);
                    $calendar.mcodeCalendar();
                } else {
                    console.log(json.error);
                }

                $('table.calendar-grid form').on('click', function () {
                    $(this).submit();
                });

            }, 'json');
        },
    };

    $.fn.mcodeCalendar = function (options) {
        return methods.init.apply(this, arguments);
    };

})(jQuery);