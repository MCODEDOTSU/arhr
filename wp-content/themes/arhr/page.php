<?php get_header(); ?>

<?php if (is_front_page()): ?>

    <div class="page homepage">

        <?php get_template_part('inc/homepage/geography'); ?>

        <?php get_template_part('inc/homepage/news-calendar'); ?>

        <?php get_template_part('inc/homepage/advantages'); ?>

        <?php get_template_part('inc/homepage/experts'); ?>

        <?php get_template_part('inc/homepage/partners'); ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile ?>

    </div>

<?php else: ?>

    <div class="page page-content fix">

        <?php while (have_posts()) : the_post(); ?>

            <h1><?php the_title(); ?></h1>

            <?php if (has_post_thumbnail() && !empty(get_the_post_thumbnail_url(get_the_ID()))): ?>

                <a href="<?= get_the_post_thumbnail_url() ?>"><?php the_post_thumbnail('thumbnail'); ?></a>

            <?php endif; ?>

            <?php the_content(); ?>

            <?php comments_template('/comments.php', true); ?>

        <?php endwhile ?>

    </div>

<?php endif; ?>

<?php get_footer(); ?>