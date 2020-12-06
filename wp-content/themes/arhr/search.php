<?php
/*
Template Name: Search Page
*/

get_header(); ?>

    <div class="searchpage page-content fix">

        <h1><?= __('Search:', 'arhr') ?> "<?= get_search_query(); ?>"</h1>

        <?php get_search_form(); ?>

        <?php if (have_posts()) : ?>

            <?php while (have_posts()): the_post(); ?>

                <div class="post-item">

                    <?php if (has_post_thumbnail() && !empty(get_the_post_thumbnail_url(get_the_ID(), 'medium'))): ?>

                        <a class="post-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                            <?php the_post_thumbnail('medium') ?>
                        </a>

                        <a class="post-data post-has-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                            <h3 class="post-title"><?= get_the_title() ?></h3>
                            <p class="post-description"><?= get_the_excerpt() ?></p>
                            <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p>
                        </a>

                    <?php else: ?>

                        <a class="post-data" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                            <h3 class="post-title"><?= get_the_title() ?></h3>
                            <p class="post-description"><?= get_the_excerpt() ?></p>
                            <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p>
                        </a>

                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

            <?php the_posts_pagination([
                'end_size' => 3,
                'mid_size' => 3,
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>'
            ]); ?>

        <?php endif ?>

    </div>

<?php get_footer(); ?>