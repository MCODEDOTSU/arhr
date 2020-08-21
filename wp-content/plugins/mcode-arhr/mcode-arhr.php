<?php
/*
	Plugin Name: ARHR by MCODE
	Author: Brykova Aliona (e.sirotkina@mcode.su)
	Author URI: https://mcode.su/
*/

global $wpdb;
$wpdb->arhr_experts = $wpdb->prefix . 'arhr_experts';
global $arhr_experts_version;
$arhr_experts_version = '1.2';
$wpdb->arhr_partners = $wpdb->prefix . 'arhr_partners';
global $arhr_partners_version;
$arhr_partners_version = '1.2';
$wpdb->arhr_advantages = $wpdb->prefix . 'arhr_advantages';
global $arhr_advantages_version;
$arhr_advantages_version = '1.2';

function mcode_arhr_install() {

    global $wpdb;
    global $arhr_experts_version;
    global $arhr_partners_version;
    global $arhr_advantages_version;

    $charset = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    if(@is_file(ABSPATH.'/wp-admin/includes/upgrade.php')) {
        include_once(ABSPATH.'/wp-admin/includes/upgrade.php');
    } elseif(@is_file(ABSPATH.'/wp-admin/upgrade-functions.php')) {
        include_once(ABSPATH.'/wp-admin/upgrade-functions.php');
    } else {
        die('We have problem finding your \'/wp-admin/upgrade-functions.php\' and \'/wp-admin/includes/upgrade.php\'');
    }

    // EXPERTS
    if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->arhr_experts}'") != $wpdb->arhr_experts) {

        $sql = 	"CREATE TABLE {$wpdb->arhr_experts} (
				id INT NOT NULL auto_increment,
				firstname VARCHAR(255) NOT NULL,
				lastname VARCHAR(255) NOT NULL,
				middlename VARCHAR(255),
				post VARCHAR(255),
				description TEXT,
				photo INT,
				lang VARCHAR(5),
				PRIMARY KEY (id)
				)
				$charset;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("arhr_experts_version", $arhr_experts_version);
    }

    // PARTNERS
    if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->arhr_partners}'") != $wpdb->arhr_partners) {

        $sql = 	"CREATE TABLE {$wpdb->arhr_partners} (
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(255) NOT NULL,
				url VARCHAR(255),
				description TEXT,
				image INT,
				lang VARCHAR(5),
				PRIMARY KEY (id)
				)
				$charset;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("arhr_partners_version", $arhr_partners_version);
    }

    // ADVANTAGES
    if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->arhr_advantages}'") != $wpdb->arhr_advantages) {

        $sql = 	"CREATE TABLE {$wpdb->arhr_advantages} (
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(255) NOT NULL,
				description TEXT,
				image INT,
				svg TEXT,
				lang VARCHAR(5),
				PRIMARY KEY (id)
				)
				$charset;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("arhr_advantages_version", $arhr_advantages_version);
    }

}
register_activation_hook(__FILE__, 'mcode_arhr_install');

if (is_admin()) {

    add_action('admin_menu', 'mcode_arhr_admin');

    wp_register_style('mcode_arhr_style', plugins_url('/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_arhr_style');

    wp_register_script('mcode_arhr_script', plugins_url('/inc/js/script.js', __FILE__), array('jquery'));
    wp_enqueue_script('mcode_arhr_script');

}
function mcode_arhr_admin()
{
    add_menu_page('РОСХИМРЕАКТИВ, настройки', 'РОСХИМРЕАКТИВ', 'manage_options', 'mcode_arhr', 'mcode_arhr_experts_menu', 'dashicons-admin-tools');
    add_submenu_page('mcode_arhr', 'Эксперты', 'Эксперты', 'manage_options', 'mcode_arhr_experts', 'mcode_arhr_experts_menu');
    add_submenu_page('mcode_arhr', 'Партнёры', 'Партнёры', 'manage_options', 'mcode_arhr_partners', 'mcode_arhr_partners_menu');
    add_submenu_page('mcode_arhr', 'Преимущества', 'Преимущества', 'manage_options', 'mcode_arhr_advantages', 'mcode_arhr_advantages_menu');
}

/**
 * Страница редактирования экспертов
 */
function mcode_arhr_experts_menu()
{
    wp_enqueue_media();
    $experts = arhr_experts_get();
    $languages = pll_languages_list();
    require_once plugin_dir_path(__FILE__) . 'settings/experts.php';
}

/**
 * Страница редактирования партнёров
 */
function mcode_arhr_partners_menu()
{
    wp_enqueue_media();
    $partners = arhr_partners_get();
    $languages = pll_languages_list();
    require_once plugin_dir_path(__FILE__) . 'settings/partners.php';
}

/**
 * Страница редактирования преимуществ
 */
function mcode_arhr_advantages_menu()
{
    wp_enqueue_media();
    $advantages = arhr_advantages_get();
    $languages = pll_languages_list();
    require_once plugin_dir_path(__FILE__) . 'settings/advantages.php';
}

//if ( ! class_exists( '_WP_Editors', false ) ) {
//    require( ABSPATH . WPINC . '/class-wp-editor.php' );
//}
//add_action( 'admin_print_footer_scripts', array( '_WP_Editors', 'print_default_editor_scripts' ) );

require_once plugin_dir_path(__FILE__) . 'db/experts.php';
require_once plugin_dir_path(__FILE__) . 'db/partners.php';
require_once plugin_dir_path(__FILE__) . 'db/advantages.php';