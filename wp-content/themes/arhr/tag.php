<?php get_header(); ?>

    <div class="category page-content fix">

        <h1 class="post-tags">
            <span><?php single_cat_title(); ?></span>
        </h1>

        <?php $description = get_term_meta( get_queried_object_id(), 'category_description', true); ?>
        <?php echo apply_filters( 'the_content', $description ); ?>

        <?php if (have_posts()) : ?>

            <div class="post-items">

                <?php while (have_posts()): the_post(); ?>

                    <div class="post-item"><!--

                        <?php if (has_post_thumbnail() && !empty(get_the_post_thumbnail_url(get_the_ID(), 'medium'))): ?>

                            --><a class="post-thumbnail" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>" style="background-image: url('<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>')"></a><!--

                        <?php else: ?>

                            --><div class="post-thumbnail"></div><!--

                        <?php endif; ?>

                     --><div class="post-data post-has-thumbnail">

                            <p class="post-metadata"><?= get_the_time('d.m.Y') ?></p><!--

                         --><h3 class="post-title" >
                                <a href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>"><?= get_the_title() ?></a>
                            </h3>

                            <div class="post-description pc">
                                <a class="post-title" href="<?= get_permalink(get_the_ID()) ?>" title="<?= get_the_title() ?>">
                                    <?= get_the_excerpt() ?>
                                </a>
                            </div>

                            <div class="post-categories">
                                <?php
                                $currentCategoryId = get_queried_object()->term_id;
                                $categories = wp_get_post_categories(get_the_ID(), [ 'fields' => 'all' ]);
                                foreach( $categories as $category ){
                                    if ($category->parent != $currentCategoryId) {
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

<?php get_footer(); ?>