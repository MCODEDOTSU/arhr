<?php
    $day = $_POST['date'];
    get_header();
?>

<?php get_header(); ?>

    <div class="category category-anonsy page-content fix">

        <div class="category-content">

            <h1><?php single_cat_title(); ?><?php if (!empty($day)) { echo ": $day"; } ?></h1>

            <?php echo category_description(); ?>

            <div class="sidebar sidebar-anonsy">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar('sidebar-anonsy');
                }
                ?>
            </div>

            <?php
            $option = [
                'category_name' => 'event-announcements',
                'paged' => get_query_var( 'paged' ),
                'post_status' => 'publish',
                'orderby' => 'meta_value',
                'meta_key' => 'event_date_start',
                'order' => 'DESC'
            ];
            if (!empty($day)) {
                $option['meta_query'] = [
                    'key' => 'event_date_start',
                    'value' => $day,
                    'type' => 'DATE'
                ];
            }
            $query = new WP_Query($option);
            ?>

            <?php if ($query->have_posts()) : ?>

                <?php while ($query->have_posts()): $query->the_post(); ?>

                    <div class="post-item">

                        <?php if (has_post_thumbnail()): ?>

                            <a class="post-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                <?php the_post_thumbnail('medium') ?>
                            </a>

                            <a class="post-data post-has-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                <h3 class="post-title"><?= get_the_title() ?></h3>
                                <p class="post-description"><?= get_the_excerpt() ?></p>
                                <p class="post-metadata">
                                    <?php
                                    if (get_post_meta( get_the_ID(), 'event_date_start', true ) != '') {
                                        echo __('Start: ', 'arhr') . get_post_meta( get_the_ID(), 'event_date_start', true );
                                        if (get_post_meta( get_the_ID(), 'event_date_finish', true ) != '') {
                                            echo '<br>';
                                        }
                                    }
                                    if (get_post_meta( get_the_ID(), 'event_date_finish', true ) != '') {
                                        echo __('Ending: ', 'arhr') . get_post_meta( get_the_ID(), 'event_date_finish', true );
                                    }
                                    ?>
                                </p>
                            </a>

                        <?php else: ?>

                            <a class="post-data" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                <h3 class="post-title"><?= get_the_title() ?></h3>
                                <p class="post-description"><?= get_the_excerpt() ?></p>
                                <p class="post-metadata">
                                    <?php
                                    if (get_post_meta( get_the_ID(), 'event_date_start', true ) != '') {
                                        echo __('Start: ', 'arhr') . get_post_meta( get_the_ID(), 'event_date_start', true );
                                        if (get_post_meta( get_the_ID(), 'event_date_finish', true ) != '') {
                                            echo '<br>';
                                        }
                                    }
                                    if (get_post_meta( get_the_ID(), 'event_date_finish', true ) != '') {
                                        echo __('Ending: ', 'arhr') . get_post_meta( get_the_ID(), 'event_date_finish', true );
                                    }
                                    ?>
                                </p>
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

    </div>

<?php get_footer(); ?>