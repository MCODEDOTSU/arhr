<?php get_header(); ?>

    <div class="category page-content fix">

        <h1><?php single_cat_title(); ?></h1>

        <?php echo category_description(); ?>

        <?php if (have_posts()) : ?>

            <div class="post-items">

                <?php while (have_posts()): the_post(); ?>

                    <div class="post-item"><!--

                        <?php if (has_post_thumbnail()): ?>

                            --><a class="post-thumbnail" href="<?= get_permalink(get_the_ID()) ?>"
                               title="<?= get_the_title() ?>"
                               style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')">
                            </a><!--

                        <?php else: ?>

                            --><div class="post-thumbnail"></div><!--

                        <?php endif; ?>

                        --><a class="post-data post-has-thumbnail" href="<?= get_permalink(get_the_ID()) ?>"
                           title="<?= get_the_title() ?>">
                            <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p><!--
                            --><h3 class="post-title"><?= get_the_title() ?></h3>
                            <div class="post-description"><?= get_the_excerpt() ?></div>
                        </a>

                    </div>

                <?php endwhile; ?>

            </div>

            <?php the_posts_pagination([
                'end_size' => 3,
                'mid_size' => 3,
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>'
            ]); ?>

        <?php endif ?>

    </div>

<?php get_footer(); ?>