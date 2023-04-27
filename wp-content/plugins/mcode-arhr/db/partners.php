<?php

/**
 * Получить список партнёров
 * @param string $lang
 * @return array|null|object
 */
function arhr_partners_get($lang = '') {
    global $wpdb;
    $languages = pll_languages_list();
    $lang = in_array($lang, $languages) ? $lang : '';
    $sql = empty($lang) ? "SELECT * FROM " . $wpdb->arhr_partners :
        "SELECT * FROM " . $wpdb->arhr_partners . " WHERE lang = '$lang' AND is_published = TRUE";
    return $wpdb->get_results($sql, ARRAY_A);
}

/**
 * Изменить партнёра
 */
function arhr_partners_update()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'description' => $_POST['description'],
        'image' => (int)$_POST['image'],
        'lang' => $_POST['lang'],
    ];
    if($wpdb->update( $wpdb->arhr_partners, $data, [ 'id' => $id ], [ '%s', '%s', '%s', '%d', '%s' ], [ '%d' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_partners_update', 'arhr_partners_update');

/**
 * Добавить партнёра
 */
function arhr_partners_insert()
{
    global $wpdb;
    $data = [
        'name' => $_POST['name'],
        'url' => $_POST['url'],
        'description' => $_POST['description'],
        'image' => (int)$_POST['image'],
        'lang' => $_POST['lang'],
    ];
    if($wpdb->insert( $wpdb->arhr_partners, $data, [ '%s', '%s', '%s', '%d', '%s' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $wpdb->insert_id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_partners_insert', 'arhr_partners_insert');

/**
 * Удалить партнёра
 */
function arhr_partners_delete()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    if ($wpdb->delete( $wpdb->arhr_partners, [ 'id' => $id ], [ '%d'] ) === false ) {
        $result = ['status' => 'error', 'result' => $wpdb->last_query];
    } else {
        $result = ['status' => 'success', 'result' => $id];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_partners_delete', 'arhr_partners_delete');

/**
 * Активировать преимущесто
 */
function arhr_partners_activate()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    if($wpdb->update( $wpdb->arhr_partners, ['is_published' => true], [ 'id' => $id ]) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_error  ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_partners_activate', 'arhr_partners_activate');

/**
 * Деактивировать преимущесто
 */
function arhr_partners_deactivate()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    if($wpdb->update( $wpdb->arhr_partners, ['is_published' => false], [ 'id' => $id ]) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_error  ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_partners_deactivate', 'arhr_partners_deactivate');