<h2>География Партнерства</h2>

<div class="members-map">
    <?php get_template_part('inc/members/map'); ?>
</div><!--
--><div class="members-list">
    <ul>
        <li class="animate" data-item="01" title="<?= __('Central (Central Federal District)', 'arhr') ?>"><?= __('Central (Central Federal District)', 'arhr') ?></li>
        <li class="animate" data-item="02" title="<?= __('Northwestern (NWFD)', 'arhr') ?>"><?= __('Northwestern (NWFD)', 'arhr') ?></li>
        <li class="animate" data-item="05" title="<?= __('Privolzhsky (Volga Federal District)', 'arhr') ?>"><?= __('Privolzhsky (Volga Federal District)', 'arhr') ?></li>
        <li class="animate" data-item="06" title="<?= __('Uralsky (UFO)', 'arhr') ?>"><?= __('Uralsky (UFO)', 'arhr') ?></li>
        <li class="animate" data-item="07" title="<?= __('Siberian (Siberian Federal District)', 'arhr') ?>"><?= __('Siberian (Siberian Federal District)', 'arhr') ?></li>
        <li class="animate" data-item="09" title="<?= __('Republic of Belarus', 'arhr') ?>"><?= __('Republic of Belarus', 'arhr') ?></li>
        <li class="animate" data-item="10" title="<?= __('The Republic of Kazakhstan', 'arhr') ?>"><?= __('The Republic of Kazakhstan', 'arhr') ?></li>
    </ul>
</div>


<script>
    (function ($) {

        $(document).ready(function (e) {
            map_init();
            list_init();
        });

        function map_init() {
            $('#map .a, #map .b, #map .d').on('mouseover', function () {
                const location = $(this).parents('g').data('item');
                if ($(this).parents('g').find('circle').length === 0) {
                    return;
                }
                $(this).parents('g').find('path').addClass('hover');
                $(this).parents('g').find('circle').addClass('hover');
                $(`.members-list li[data-item="${location}"]`).addClass('hover');
            });
            $('#map .a, #map .b, #map .d').on('mouseout', function () {
                const location = $(this).parents('g').data('item');
                if ($(this).parents('g').find('circle').length === 0) {
                    return;
                }
                $(this).parents('g').find('path').removeClass('hover');
                $(this).parents('g').find('circle').removeClass('hover');
                $(`.members-list li[data-item="${location}"]`).removeClass('hover');
            });
            $('#map .a, #map .b, #map .d').on('click', function () {
                const location = $(this).parents('g').data('item');
                $('html, body').stop().animate({ scrollTop: $(`#location-${location}`).offset().top }, 1000);
            });
        }

        function list_init() {
            $('.members-list li').on('mouseover', function () {
                let location = $(this).data('item');
                $(`.members-map svg g[data-item="${location}"] .a`).addClass('hover');
                $(`.members-map svg g[data-item="${location}"] .b`).addClass('hover');
                $(`.members-map svg g[data-item="${location}"] .d`).addClass('hover');
            });
            $('.members-list li').on('mouseout', function () {
                let location = $(this).data('item');
                $(`.members-map svg g[data-item="${location}"] .a`).removeClass('hover');
                $(`.members-map svg g[data-item="${location}"] .b`).removeClass('hover');
                $(`.members-map svg g[data-item="${location}"] .d`).removeClass('hover');
            });
            $('.members-list li').on('click', function () {
                let location = $(this).data('item');
                $('html, body').stop().animate({ scrollTop: $(`#location-${location}`).offset().top }, 1000);
            });
        }

    })(jQuery);
</script>
