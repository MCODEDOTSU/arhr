<?php get_header(); ?>

    <div class="single page-content fix">

        <div class="border">

            <?php if (have_posts()) : the_post(); ?>

                <?php if (has_post_thumbnail()): ?>

                    <a class="post-thumbnail" href="<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>"
                       style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')">
                    </a>

                <?php else: ?>

                    <div class="post-thumbnail"></div>

                <?php endif; ?>

                <div class="post-title post-has-thumbnail">

                    <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p>

                    <h1><?php the_title(); ?></h1>

                </div>

                <?php the_content() ?>

                <?php the_tags('<div class="post-tags">', '', '</div>') ?>

            <?php endif ?>

        </div>

        <?php comments_template('/comments.php', true) ?>

    </div>

<?php get_footer(); ?>