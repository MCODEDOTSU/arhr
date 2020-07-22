<?php get_header(); ?>

    <div class="page homepage">

        <?php while (have_posts()) : the_post(); ?>

            <?php the_content(); ?>

            <?php get_template_part('inc/homepage-advantages'); ?>

        <?php endwhile ?>

    </div>

<?php get_footer(); ?>