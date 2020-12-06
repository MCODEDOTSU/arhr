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

                    <?php if (has_post_thumbnail() && !empty(get_the_post_thumbnail_url(get_the_ID(), 'medium'))): ?>

                        --><a class="news-thumbnail" href="<?= get_permalink(get_the_ID()) ?>"
                           title="<?= get_the_title() ?>"
                           style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')">
                        </a><!--

                    <?php else: ?>

                        --><div class="news-thumbnail"></div><!--

                    <?php endif; ?>

                    --><div class="news-data"><a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">

                        <span class="news-date">
                            <?= get_the_time('d.m.Y') ?>
                        </span><!--

                        --><h3 class="news-title">
                            <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                <?= get_the_title() ?>
                            </a>
                        </h3>

                        <p class="news-description pc">
                            <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                <?= get_the_excerpt() ?>
                            </a>
                        </p>

                    </a></div>

                    <p class="news-description mb">
                        <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                            <?= get_the_excerpt() ?>
                        </a>
                    </p>

                </article>

            <?php }

            wp_reset_postdata();

        } ?>

        <div class="actions">
            <a class="news-category" href="<?= get_category_link( get_post_meta(get_the_ID(), 'homepage_news_category', true) ) ?>">
                <?= __('watch more', 'arhr') ?>
            </a>
        </div>

    </div><!--

    --><div class="calendar-container pc">
        <?php
        if (function_exists('mcode_calendar_get_days_month_calendar')) {
            echo mcode_calendar_get_days_month_calendar(4);
        }
        ?>
    </div>

</div>