<div class="map">
    <div class="fix">

        <div class="map-description">

            <h2><?= get_post_meta(get_the_ID(), 'homepage_map_title', true) ?></h2>
            <p><?= get_post_meta(get_the_ID(), 'homepage_map_text', true) ?></p>

            <?php if (get_post_meta(get_the_ID(), 'homepage_map_link', true)) { ?>
                <a class="btn" href="<?= get_post_meta(get_the_ID(), 'homepage_map_link', true) ?>"><?= get_post_meta(get_the_ID(), 'homepage_map_button_text', true) ?></a>
            <?php } ?>

            <?php if (get_post_meta(get_the_ID(), 'homepage_map_link_2', true)) { ?>
                <a class="btn btn-2" href="<?= get_post_meta(get_the_ID(), 'homepage_map_link_2', true) ?>"><?= get_post_meta(get_the_ID(), 'homepage_map_button_text_2', true) ?></a>
            <?php } ?>

        </div><!--
    --><div class="map-container">

            <?php get_template_part('inc/homepage/map'); ?>

        </div>


        <!-- Всплывающие окна -->
        <?php $list = arhr_get_members_list() ?>

        <?php foreach( $list as $id => $location ) { ?>
            <div class="map-item location-<?= $id ?> animate" data-link="<?= get_post_meta(get_the_ID(), 'homepage_members_link', true) ?>#location-<?= $id ?>">
                <p class="map-item-count"><?= $location['title'] ?>: <span><?= count($location['items']) ?></span></p>
                <?php foreach( $location['items'] as $i => $item ) { ?>
                    <p class="map-item-name"><a href="<?= $item['url'] ?>" title="<?= $item['title'] ?>" target="_blank"><?= $item['title'] ?></a></p>
                    <?php if ($i == 1) break; ?>
                <?php } ?>
                <a class="btn btn-link" href="<?= get_post_meta(get_the_ID(), 'homepage_members_link', true) ?>#location-<?= $id ?>" target="_blank">Смотреть ещё</a>
            </div>
        <?php } ?>

    </div>
</div>

<script>
    (function ($) {

        $(document).ready(function (e) {
            map_init();
        });

        function map_init() {
            $('#map g').on('mouseover', function () {
                const location = $(this).data('item');
                $(`.homepage .map-item.location-${location}`).addClass('hover');
            });
            $('#map g').on('mouseout', function () {
                const location = $(this).data('item');
                $(`.homepage .map-item.location-${location}`).removeClass('hover');
            });
            $('#map g').on('click', function () {
                const location = $(this).data('item');
                const url = $(`.homepage .map-item.location-${location}`).data('link');
                window.open(url);
            });
        }

    })(jQuery);
</script>
