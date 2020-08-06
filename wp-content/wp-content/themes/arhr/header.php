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

                <a href="/" class="logo">

                    <?php if (is_front_page()): ?>

                        <h1 class="title"><?= get_theme_mod('site_title_' . get_locale(), 'МОЙ САЙТ') ?></h1>

                        <h2 class="description"><?= get_theme_mod('site_description_' . get_locale(), 'описание сайта') ?></h2>

                    <?php else: ?>

                        <h2 class="title"><?= get_theme_mod('site_title_' . get_locale(), 'МОЙ САЙТ') ?></h2>

                        <h3 class="description"><?= get_theme_mod('site_description_' . get_locale(), 'описание сайта') ?></h3>

                    <?php endif; ?>

                </a>

            </div>

            <div class="main-right">

                <?php get_search_form() ?>

                <div class="contacts">

                    <a class="phone" href="tel:<?= get_theme_mod('phone_header', '') ?>">
                        <?= get_theme_mod('phone_header', '') ?>
                    </a>

                    <a class="btn" href="<?= get_theme_mod('write_link', '#') ?>">
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
                    <li><a href="<?= get_theme_mod('facebook_link', '#') ?>" class="facebook" target="_blank"></a></li>
                    <li><a href="<?= get_theme_mod('vkontakte_link', '#') ?>" class="vkontakte" target="_blank"></a></li>
                    <li><a href="<?= get_theme_mod('youtube_link', '#') ?>" class="youtube" target="_blank"></a></li>
                    <li><a href="<?= get_theme_mod('instagram_link', '#') ?>" class="instagram" target="_blank"></a></li>
                    <li><a href="<?= get_theme_mod('linkedin_link', '#') ?>" class="linkedin" target="_blank"></a></li>
                </ul>
            </div>
        </div>
    </nav>


</header>

<div class="wrapper">

	