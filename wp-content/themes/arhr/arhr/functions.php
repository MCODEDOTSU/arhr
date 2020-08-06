<?php

add_theme_support('post-thumbnails');
add_theme_support('menus');

/* enqueue scripts */
function arhr_enqueue_scripts()
{
    wp_enqueue_style('main', get_template_directory_uri() . '/style.css', array(), date('His'));
    wp_enqueue_script('core', get_template_directory_uri() . '/js/core.js', date('His'));
    wp_enqueue_script('touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js');
    wp_enqueue_style('responsive', get_template_directory_uri() . '/responsive.css', [], date('His'));
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css', []);
    wp_enqueue_style('font-lato', get_template_directory_uri() . '/fonts/Lato2OFL/fonts.css', []);
}

add_action('wp_enqueue_scripts', 'arhr_enqueue_scripts');
/* end enqueue scripts */

/* sidebars */
function arhr_register_sidebar()
{
    register_sidebar([
        'name' => 'Подвал, блок №1',
        'id' => 'footer-1',
        'description' => 'Подвал, блок №1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
    register_sidebar([
        'name' => 'Подвал, блок №2',
        'id' => 'footer-2',
        'description' => 'Подвал, блок №2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
    register_sidebar([
        'name' => 'Подвал, блок №3',
        'id' => 'footer-3',
        'description' => 'Подвал, блок №3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
    register_sidebar([
        'name' => 'Подвал, блок №4',
        'id' => 'footer-4',
        'description' => 'Подвал, блок №4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
    register_sidebar([
        'name' => 'На странице анонсов',
        'id' => 'sidebar-anonsy',
        'description' => 'На странице анонсов',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
}

add_action('widgets_init', 'arhr_register_sidebar');
/* end sidebars */

/* menu */

class MenuWalker extends Walker_Nav_Menu
{
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>";
    }
}

function arhr_register_menu()
{
    register_nav_menu('top', 'Меню над шапкой сайта');
    register_nav_menu('header', 'Меню под шапкой');
}

add_action('after_setup_theme', 'arhr_register_menu');
/* end menu */

/* expert */
add_filter('excerpt_length', function () {
    return 25;
});
add_filter('excerpt_more', function ($more) {
    return ' ...';
});
/* end expert */

/* comments */
function arhr_comment_form($fields)
{
    unset($fields['url']);
    return $fields;
}
add_filter("comment_form_default_fields", "arhr_comment_form");
/* end comments */

/* languages */
function arhr_after_setup_theme()
{
    load_theme_textdomain('arhr', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'arhr_after_setup_theme');
/* end languages */

/* theme settings */
require get_template_directory() . '/inc/theme-setting.php';
function arhr_theme_setting_style()
{
    require get_template_directory() . '/inc/theme-setting-style.php';
}
add_action('wp_head', 'arhr_theme_setting_style');
/* end theme settings */