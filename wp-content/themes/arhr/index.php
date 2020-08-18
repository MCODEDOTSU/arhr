<?php get_header(); ?>

    <div class="page homepage">

        <?php get_template_part('inc/homepage/geography'); ?>

        <?php get_template_part('inc/homepage/news-calendar'); ?>

        <?php get_template_part('inc/homepage/advantages'); ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile ?>

    </div>

<?php get_footer(); ?>