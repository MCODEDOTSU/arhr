<?php get_header(); ?>

    <div class="category">

        <h1><?php single_cat_title(); ?></h1>

        <?php echo category_description(); ?>

        <?php if (have_posts()) : ?>

            <?php
            while (have_posts()):
                the_post();
                ?>
                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                    <h3><?= get_the_title() ?></h3>
                </a>

            <?php endwhile; ?>

            <?php the_posts_pagination(['screen_reader_text' => '']); ?>

        <?php endif ?>

    </div>

<?php get_footer(); ?>