<?php

/**
 * Получить список преимуществ
 * @param string $lang
 * @return array|null|object
 */
function arhr_advantages_get($lang = '') {
    global $wpdb;
    $languages = pll_languages_list();
    $lang = in_array($lang, $languages) ? $lang : '';
    $sql = empty($lang) ? "SELECT * FROM " . $wpdb->arhr_advantages :
        "SELECT * FROM " . $wpdb->arhr_advantages . " WHERE lang = '$lang'";
    return $wpdb->get_results($sql, ARRAY_A);
}

/**
 * Изменить преимущесто
 */
function arhr_advantages_update()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image' => (int)$_POST['image'],
        'svg' => htmlspecialchars($_POST['svg']),
        'lang' => $_POST['lang'],
    ];
    if($wpdb->update( $wpdb->arhr_advantages, $data, [ 'id' => $id ], [ '%s', '%s', '%d', '%s', '%s' ], [ '%d' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_advantages_update', 'arhr_advantages_update');

/**
 * Добавить преимущесто
 */
function arhr_advantages_insert()
{
    global $wpdb;
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image' => (int)$_POST['image'],
        'svg' => htmlspecialchars($_POST['svg']),
        'lang' => $_POST['lang'],
    ];
    if($wpdb->insert( $wpdb->arhr_advantages, $data, [ '%s', '%s', '%d', '%s', '%s' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_query ];
    } else {
        $result = [ 'status' => 'success', 'result' => $wpdb->insert_id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_advantages_insert', 'arhr_advantages_insert');

/**
 * Удалить преимущесто
 */
function arhr_advantages_delete()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    if ($wpdb->delete( $wpdb->arhr_advantages, [ 'id' => $id ], [ '%d'] ) === false ) {
        $result = ['status' => 'error', 'result' => $wpdb->last_query];
    } else {
        $result = ['status' => 'success', 'result' => $id];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_advantages_delete', 'arhr_advantages_delete');