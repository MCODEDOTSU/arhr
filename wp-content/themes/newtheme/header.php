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

    <?php if (is_front_page()): ?>

        <h1><?= bloginfo('name') ?></h1>

        <h2><?= bloginfo('description') ?></h2>

    <?php else: ?>

        <h2><?= bloginfo('name') ?></h2>

        <h3><?= bloginfo('description') ?></h3>

    <?php endif; ?>

    <nav>
        <?php wp_nav_menu(['theme_location' => 'location', 'container_class' => 'menu-container', 'walker' => new MenuWalker()]) ?>
    </nav>

    <?php get_search_form() ?>

</header>

<div class="wrapper">

	