<?php
/**
 * Template Name: Members of the Association
 */
?>

<?php get_header(); ?>

<div class="page page-content page-members fix">

    <?php while (have_posts()) : the_post(); ?>

        <h1><?php the_title(); ?></h1>

        <?php the_content(); ?>

        <!-- Список Членов -->

        <?php

        $pages = get_posts([
            'post_parent' => get_the_ID(),
            'numberposts' => -1,
            'post_status' => 'publish',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_key' => 'member_item_location',
            'post_type' => 'page',
        ]);

        $location = 0;

        ?> <div class="member-items"> <?php

        foreach( $pages as $page ) {

            $item_location = get_post_meta($page->ID, 'member_item_location', true);
            if ($location != $item_location) {
                ?> <h2><?= arhr_get_location_name($item_location) ?></h2><div> <?php
            }

            $logo = get_post_meta($page->ID, 'member_item_logo', true);
            $director = get_post_meta($page->ID, 'member_item_direktor', true);
            $email = get_post_meta($page->ID, 'member_item_email', true);
            $address = get_post_meta($page->ID, 'member_item_address', true);
            $site = get_post_meta($page->ID, 'member_item_site', true);
            $phone = get_post_meta($page->ID, 'member_item_phone', true);
            $fax = get_post_meta($page->ID, 'member_item_fax', true);

            ?> <div class="member-item">

                <div class="member-item-close">

                    <span class="title">

                        <?php if(!empty($logo)) { ?>
                            <img src="<?= wp_get_attachment_image_url($logo, 'thumbnail') ?>" />
                        <?php } else { ?>
                            <img src="<?= get_template_directory_uri() ?>/img/thumb-150-150.png" />
                        <?php } ?>

                        <div class="member-item-title">

                            <h3><?= $page->post_title ?></h3>

                            <?php if(!empty($director)) { ?>
                                <span class="member-item-director">
                                        <?= $director ?>
                                    </span>
                            <?php } ?>

                            <?php if(!empty($email)) { ?>
                                <span class="member-item-email">
                                        <a href="mailto:<?= $email ?>" title="<?= __('write a letter', 'arhr') ?>"><?= __('write a letter', 'arhr') ?></a>
                                    </span>
                            <?php } ?>

                        </div>

                    </span>

                </div>

                <div class="member-item-open">

                    <table>
                        <tr>
                            <td class="title">

                                <?php if(!empty($logo)) { ?>
                                    <img src="<?= wp_get_attachment_image_url($logo, 'thumbnail') ?>" />
                                <?php } else { ?>
                                    <img src="<?= get_template_directory_uri() ?>/img/thumb-150-150.png" />
                                <?php } ?>

                                <div class="member-item-title">

                                    <h3><?= $page->post_title ?></h3>

                                    <?php if(!empty($director)) { ?>
                                        <span class="member-item-director">
                                        <?= $director ?>
                                    </span>
                                    <?php } ?>

                                    <?php if(!empty($email)) { ?>
                                        <span class="member-item-email">
                                        <a href="mailto:<?= $email ?>" title="<?= __('write a letter', 'arhr') ?>"><?= __('write a letter', 'arhr') ?></a>
                                    </span>
                                    <?php } ?>

                                </div>

                            </td>
                            <td class="contacts">

                                <?php if(!empty($address)) { ?>
                                    <span class="member-item-data">
                                    <label class="title">
                                        <?= __('Mailing address', 'arhr') ?>
                                    </label>
                                        <?= $address ?>
                                </span>
                                <?php } ?>

                                <?php if(!empty($site)) { ?>
                                    <span class="member-item-data">
                                    <label class="title">
                                        <?= __('Web site', 'arhr') ?>
                                    </label>
                                    <a href="<?= $site ?>" title="<?= __('Web site', 'arhr') ?>"><?= $site ?></a>
                                </span>
                                <?php } ?>

                            </td>
                            <td class="contacts">

                                <?php if(!empty($phone)) { ?>
                                    <span class="member-item-data">
                                    <label class="title">
                                        <?= __('Phone', 'arhr') ?>
                                    </label>
                                    <a href="tel:<?= $phone ?>" title="<?= __('Phone', 'arhr') ?>"><?= $phone ?></a>
                                </span>
                                <?php } ?>

                                <?php if(!empty($fax)) { ?>
                                    <span class="member-item-data">
                                    <label class="title">
                                        <?= __('Fax', 'arhr') ?>
                                    </label>
                                    <a href="tel:<?= $fax ?>" title="<?= __('Fax', 'arhr') ?>"><?= $fax ?></a>
                                </span>
                                <?php } ?>

                            </td>
                        </tr>
                    </table>

                    <div class="article">

                        <?php
                        $content = get_the_content('читать далее', '', $page->ID);
                        echo apply_filters( 'the_content', $content );
                        ?>

                    </div>

                    <span class="actions">
                        <button class="btn btn-link btn-close"><?= __('collapse description', 'arhr') ?></button>
                    </span>

                </div>


            </div> <?php

            if ($location != $item_location) {
                $location = $item_location;
                ?> </div> <?php
            }
        }

        ?> </div> <?php

        wp_reset_postdata();

        ?>

    <?php endwhile ?>

</div>

<?php get_footer(); ?>