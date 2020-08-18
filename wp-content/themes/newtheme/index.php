<?php get_header(); ?>

    <div class="page homepage">

        <?php while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php if (has_post_thumbnail()): ?>

                <a href="<?= get_the_post_thumbnail_url() ?>"><?php the_post_thumbnail('thumbnail'); ?></a>

            <?php endif; ?>

            <?php the_content(); ?>

            <?php comments_template('/comments.php', true); ?>

        <?php endwhile ?>

    </div>

<?php get_footer(); ?>