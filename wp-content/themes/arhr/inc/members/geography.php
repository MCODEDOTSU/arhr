<?php $list = arhr_get_members_list() ?>

<div class="members-map">
    <?php get_template_part('inc/members/map-' . pll_current_language()); ?>
</div><!--
--><div class="members-list">
    <ul>
        <?php foreach( $list as $id => $location ) { ?>
            <li class="animate" data-item="<?= $id ?>" title="<?= $location['title'] ?>"><?= $location['title'] ?></li>
        <?php } ?>
    </ul>
</div>


<script>
    (function ($) {

        $(document).ready(function (e) {
            map_init();
            list_init();
        });

        function map_init() {
            $('#map g').on('mouseover', function () {
                const location = $(this).data('item');
                $(`.members-list li[data-item="${location}"]`).addClass('hover');
            });
            $('#map g').on('mouseout', function () {
                const location = $(this).data('item');
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
                $(`.members-map svg g[data-item="${location}"]`).addClass('hover');
            });
            $('.members-list li').on('mouseout', function () {
                let location = $(this).data('item');
                $(`.members-map svg g[data-item="${location}"]`).removeClass('hover');
            });
            $('.members-list li').on('click', function () {
                let location = $(this).data('item');
                $('html, body').stop().animate({ scrollTop: $(`#location-${location}`).offset().top }, 1000);
            });
        }

    })(jQuery);
</script>
