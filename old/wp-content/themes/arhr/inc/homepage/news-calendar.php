<div class="news-calendar fix">

    <div class="calendar-container mb">
        <?php
        if (function_exists('mcode_calendar_get_days_month_calendar')) {
            echo mcode_calendar_get_days_month_calendar(4);
        }
        ?>
    </div><!--

    --><div class="news-container">

        <?php

        $query = new WP_Query([
            'cat' => get_post_meta(get_the_ID(), 'homepage_news_category', true),
            [
                'orderby' => 'date', 'order' => 'ASC'
            ],
            'posts_per_page' => get_post_meta(get_the_ID(), 'homepage_news_count', true),
            'post_type'  => 'post',
            'post_status' => 'publish'
        ]);

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post(); ?>

                <article class="news-item"><!--

                    <?php if (has_post_thumbnail()): ?>

                        --><a class="news-thumbnail" href="<?= get_permalink(get_the_ID()) ?>"
                           title="<?= get_the_title() ?>"
                           style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')">
                        </a><!--

                    <?php else: ?>

                        --><div class="news-thumbnail"></div><!--

                    <?php endif; ?>

                    --><div class="news-data">

                        <span class="news-date"><?= get_the_time('d.m.Y') ?></span><!--

                        --><h3 class="news-title"><?= get_the_title() ?></h3>

                        <p class="news-description pc"><?= get_the_excerpt() ?></p>

                    </div>

                    <p class="news-description mb"><?= get_the_excerpt() ?></p>

                </article>

            <?php }

            wp_reset_postdata();

        } ?>

        <a class="news-category" href="<?= get_category_link( get_post_meta(get_the_ID(), 'homepage_news_category', true) ) ?>"><?= __('watch more', 'arhr') ?></a>

    </div><!--

    --><div class="calendar-container pc">
        <?php
        if (function_exists('mcode_calendar_get_days_month_calendar')) {
            echo mcode_calendar_get_days_month_calendar(4);
        }
        ?>
    </div>

</div>