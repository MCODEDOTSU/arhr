<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <?php wp_head(); ?>
    <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
</head>
<body <?php body_class(); ?>>

<header>

    <div class="top fix">

        <nav class="top-menu">
            <?php wp_nav_menu(['theme_location' => 'top', 'container_class' => 'menu-container', 'depth' => 1, 'walker' => new MenuWalker()]) ?>
        </nav>

        <nav class="languages-menu">
            <ul class="menu">
                <?php pll_the_languages(); ?>
                <li><a href="/wp-login"><?= __('Account', 'arhr') ?></a></li>
            </ul>
        </nav>

    </div>

    <div class="main">

        <div class="fix">

            <div class="main-left">

                <?php $homepage = get_locale() == 'ru_RU' ? '/' : '/en'; ?>

                <a href="<?= $homepage ?>" class="logo" title="<?= bloginfo('name') ?>"></a>

            </div>

            <div class="main-right">

                <?php get_search_form() ?>

                <div class="contacts">

                    <div class="contacts-container">

                        <a class="phone" href="tel:<?= get_theme_mod('phone_header', '') ?>">
                            <?= get_theme_mod('phone_header', '') ?>
                        </a>

                        <a class="email" href="mailto:<?= get_theme_mod('email_header', '') ?>">
                            <?= get_theme_mod('email_header', '') ?>
                        </a>

                    </div>

                    <a class="btn main_button" href="<?= get_theme_mod('write_link_' . get_locale(), '#') ?>">
                        <?= __('Write to us', 'arhr') ?>
                    </a>

                </div>

            </div>

        </div>

    </div>

    <nav class="header-menu">
        <div class="fix">
            <?php wp_nav_menu(['theme_location' => 'header', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
            <div class="social-container">
                <ul class="menu">
                    <?php
                    if(!empty(get_theme_mod('facebook_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('facebook_link', '') ?>" class="facebook" target="_blank"></a></li> <?php
                    }
                    ?>
                    <?php
                    if(!empty(get_theme_mod('vkontakte_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('vkontakte_link', '') ?>" class="vkontakte" target="_blank"></a></li> <?php
                    }
                    ?>
                    <?php
                    if(!empty(get_theme_mod('youtube_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('youtube_link', '') ?>" class="youtube" target="_blank"></a></li> <?php
                    }
                    ?>
                    <?php
                    if(!empty(get_theme_mod('instagram_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('instagram_link', '') ?>" class="instagram" target="_blank"></a></li> <?php
                    }
                    ?>
                    <?php
                    if(!empty(get_theme_mod('linkedin_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('linkedin_link', '') ?>" class="linkedin" target="_blank"></a></li> <?php
                    }
                    ?>
                    <?php
                    if(!empty(get_theme_mod('zen_link', ''))) {
                        ?> <li><a href="<?= get_theme_mod('zen_link', '') ?>" class="zen" target="_blank"></a></li> <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>


</header>

<div class="wrapper">

    <?php if ( !is_front_page() && !is_home()) { ?>

        <div class="breadcrumbs fix">

            <?php if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            } ?>

        </div>

<?php } ?>