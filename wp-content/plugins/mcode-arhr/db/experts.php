<?php

/**
 * Получить список экспертов
 * @param string $lang
 * @return array|null|object
 */
function arhr_experts_get($lang = '') {
    global $wpdb;
    $languages = pll_languages_list();
    $lang = in_array($lang, $languages) ? $lang : '';
    $sql = empty($lang) ? "SELECT * FROM " . $wpdb->arhr_experts :
        "SELECT * FROM " . $wpdb->arhr_experts . " WHERE lang = '$lang'";
    return $wpdb->get_results($sql, ARRAY_A);
}

/**
 * Изменить эксперта
 */
function arhr_experts_update()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    $data = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'middlename' => $_POST['middlename'],
        'post' => $_POST['post'],
        'description' => $_POST['description'],
        'photo' => (int)$_POST['photo'],
        'lang' => $_POST['lang'],
    ];
    if($wpdb->update( $wpdb->arhr_experts, $data, [ 'id' => $id ], [ '%s', '%s', '%s', '%s', '%s', '%d', '%s' ], [ '%d' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_error  ];
    } else {
        $result = [ 'status' => 'success', 'result' => $id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_experts_update', 'arhr_experts_update');

/**
 * Добавить эксперта
 */
function arhr_experts_insert()
{
    global $wpdb;
    $data = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'middlename' => $_POST['middlename'],
        'post' => $_POST['post'],
        'description' => $_POST['description'],
        'photo' => (int)$_POST['photo'],
        'lang' => $_POST['lang'],
    ];
    if($wpdb->insert( $wpdb->arhr_experts, $data, [ '%s', '%s', '%s', '%s', '%s', '%d', '%s' ] ) === false ) {
        $result = [ 'status' => 'error', 'result' => $wpdb->last_error ];
    } else {
        $result = [ 'status' => 'success', 'result' => $wpdb->insert_id ];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_experts_insert', 'arhr_experts_insert');

/**
 * Удалить эксперта
 */
function arhr_experts_delete()
{
    global $wpdb;
    $id = (int)$_POST['id'];
    if ($wpdb->delete( $wpdb->arhr_experts, [ 'id' => $id ], [ '%d'] ) === false ) {
        $result = ['status' => 'error', 'result' => $wpdb->last_error ];
    } else {
        $result = ['status' => 'success', 'result' => $id];
    }
    echo json_encode($result);
    wp_die();
}
add_action('wp_ajax_arhr_experts_delete', 'arhr_experts_delete');