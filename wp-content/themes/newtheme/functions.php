<?php

add_theme_support('post-thumbnails');
add_theme_support('menus');

/* enqueue scripts */
function _enqueue_scripts()
{
    wp_enqueue_style('main', get_template_directory_uri() . '/style.css', [], date('His'));
    wp_enqueue_script('core', get_template_directory_uri() . '/js/core.js', date('His'));
    wp_enqueue_style('responsive', get_template_directory_uri() . '/responsive.css', [], date('His'));
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css', []);
}

add_action('wp_enqueue_scripts', '_enqueue_scripts');
/* end enqueue scripts */

/* sidebars */
function _register_sidebar()
{
    register_sidebar([
        'name' => 'Название сайдбара',
        'id' => 'id-sidebar',
        'description' => 'Описание сайдбара',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ]);
}

add_action('widgets_init', '_register_sidebar');
/* end sidebars */

/* menu */

class MenuWalker extends Walker_Nav_Menu
{
    function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $output .= "</li>";
    }
}

function _register_menu()
{
    register_nav_menu('location', 'Название меню');
}

add_action('after_setup_theme', '_register_menu');
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
function _comment_form($fields)
{
    unset($fields['url']);
    return $fields;
}
add_filter("comment_form_default_fields", "_comment_form");
/* end comments */

/* languages */
function _after_setup_theme()
{
    load_theme_textdomain('newtheme', get_template_directory() . '/languages');
}

add_action('after_setup_theme', '_after_setup_theme');
/* end languages */

/* theme settings */
require get_template_directory() . '/inc/theme-setting.php';

function _theme_setting_style()
{
    require get_template_directory() . '/inc/theme-setting-style.php';
}

add_action('wp_head', '_theme_setting_style');
/* end theme settings */