<?php get_header(); ?>

    <div class="single page-content fix">

        <?php if (have_posts()) : the_post(); ?>

            <?php if (has_post_thumbnail()): ?>

                <?php if (has_post_thumbnail()): ?>

                    <a class="post-thumbnail" href="<?= get_the_post_thumbnail_url() ?>">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>

                <?php endif; ?>

                <h1 class="post-has-thumbnail"><?php the_title(); ?></h1>

            <?php else: ?>

                <h1><?php the_title(); ?></h1>

            <?php endif; ?>

            <?php the_tags('<div class="post-tags">', '', '</div>') ?>

            <?php the_content() ?>

            <?php comments_template('/comments.php', true) ?>

        <?php endif ?>

    </div>

<?php get_footer(); ?>