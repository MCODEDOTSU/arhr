<?php

add_theme_support('post-thumbnails');
add_theme_support('menus');

/* enqueue scripts */
function arhr_enqueue_scripts()
{
    wp_enqueue_style('main', get_template_directory_uri() . '/style.css', [], date('His'));
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
    function end_el(&$output, $item, $depth = 0, $args = [])
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
    return 26;
});
add_filter('excerpt_more', function ($more) {
    return ' ...';
});
/* end expert */

/* short content */
function get_short_content() {
    $content = get_the_content('');
    $content = preg_replace('/<img[^>]+\>/i', '', $content);
    $content = apply_filters( 'the_content', $content );
    $length = wp_is_mobile() ? 1 : 4;
    $result = '';
    for($i = 0; $i < $length; $i++) {
        $text = substr( $content, 0, strpos( $content, '</p>' ) + 4);
        $result .= $text;
        $content = str_replace($text, '', $content);
    }
    return $result;
}
/* end short content */

function get_datetime_formate($datetime) {
    $tm = strtotime($datetime);
    $date = new DateTime( $datetime );
    return get_locale() == 'ru_RU' ? $date->format('d.m.Y H:i:s') : $date->format('Y-m-d H:i:s');
}

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

/* Get Location Name */
function arhr_get_location_name($id)
{
    $locations = [
        1 => __('Central (Central Federal District)', 'arhr'),
        2 => __('Northwestern (NWFD)', 'arhr'),
        3 => __('Southern (Southern Federal District)', 'arhr'),
        4 => __('North Caucasian (NCFD)', 'arhr'),
        5 => __('Privolzhsky (Volga Federal District)', 'arhr'),
        6 => __('Uralsky (UFO)', 'arhr'),
        7 => __('Siberian (Siberian Federal District)', 'arhr'),
        8 => __('Far Eastern (Far Eastern Federal District)', 'arhr'),
        9 => __('Republic of Belarus', 'arhr'),
        10 => __('The Republic of Kazakhstan', 'arhr'),
    ];
    return !empty($locations[$id]) ? $locations[$id] : '';
}
/* end Get Location Name */