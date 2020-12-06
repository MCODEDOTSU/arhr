<?php

$post_date = $_POST['date'];

$date = !empty($post_date) ? $post_date : date('Y-m-d');
$mount = date('n', strtotime($date));
$year = date('Y', strtotime($date));

get_header();
?>

<?php get_header(); ?>

    <div class="category category-anonsy page-content fix">

        <div class="category-content">

            <h1><?php single_cat_title(); ?><?php if (!empty($post_date)) { echo ": $post_date"; } ?></h1>

            <?php $description = get_term_meta( get_queried_object_id(), 'category_description', true); ?>
            <?php echo apply_filters( 'the_content', $description ); ?>

            <div class="sidebar sidebar-anonsy">
                <?php
                if (function_exists('mcode_calendar_get_full_calendar')) {
                    echo mcode_calendar_get_full_calendar($mount, $year);
                }
                ?>
            </div>

            <?php
            $section = get_option('mcode_calendar_category');
            $option = [
                'cat' => $section,
                'paged' => get_query_var('paged'),
                'post_status' => 'publish',
                'orderby' => 'meta_value',
                'meta_key' => 'event_date_start',
                'order' => 'DESC'
            ];
            if (!empty($post_date)) {
                $option['meta_query'] = [
                    'key' => 'event_date_start',
                    'value' => $post_date,
                    'type' => 'DATE'
                ];
            }
            $query = new WP_Query($option);
            ?>

            <?php if ($query->have_posts()) : ?>

                <div class="post-items">

                    <?php while ($query->have_posts()): $query->the_post(); ?>

                        <div class="post-item"><!--

                            <?php if (has_post_thumbnail() && !empty(get_the_post_thumbnail_url(get_the_ID(), 'medium'))): ?>

                             --><a class="post-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>" style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')"></a><!--

                            <?php else: ?>

                                --><div class="post-thumbnail"></div><!--

                            <?php endif; ?>

                            --><div class="post-data post-has-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">

                                <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p><!--

                             --><h3 class="post-title">
                                    <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>"><?= get_the_title() ?></a>
                                </h3>

                                <div class="post-description pc">
                                    <a class="post-title" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                        <?= get_the_excerpt() ?>
                                    </a>
                                </div>

                                <p class="post-event_date">
                                    <?php
                                    if (get_post_meta(get_the_ID(), 'event_date_start', true) != '') {
                                        echo __('Start: ', 'arhr') . ' ' . get_datetime_formate(get_post_meta(get_the_ID(), 'event_date_start', true));
                                        if (get_post_meta(get_the_ID(), 'event_date_finish', true) != '') {
                                            echo '<br>';
                                        }
                                    }
                                    if (get_post_meta(get_the_ID(), 'event_date_finish', true) != '') {
                                        echo __('Ending: ', 'arhr') . ' ' . get_datetime_formate(get_post_meta(get_the_ID(), 'event_date_finish', true));
                                    }
                                    ?>
                                </p>

                                <div class="post-categories">
                                    <?php
                                    $categories = wp_get_post_categories(get_the_ID(), [ 'fields' => 'all' ]);
                                    foreach( $categories as $category ){
                                        if ($category->parent != $section) {
                                            continue;
                                        }
                                        ?> <a href="<?= get_category_link($category->term_id) ?>" title="<?= get_cat_name($category->term_id) ?>"><?= get_cat_name($category->term_id) ?></a> <?php
                                    }
                                    ?>
                                </div>
                                
                            </div>

                            <div class="post-description mb">
                                <a class="post-title" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                    <?= get_the_excerpt() ?>
                                </a>
                            </div>

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

    </div>

<?php get_footer(); ?>