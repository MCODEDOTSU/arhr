<?php

function azexo_tgmpa_register() {
    $plugins[] = array(
        'name' => esc_html__('Core theme plugin', 'brixes'),
        'slug' => 'brixes-page-builder',
        'required' => true,
    );
    $plugins[] = array(
        'name' => esc_html__('Page Builder by AZEXO', 'brixes'),
        'slug' => 'page-builder-by-azexo',
        'required' => true,
    );
    $plugins[] = array(
        'name' => esc_html__('Redux Framework', 'brixes'),
        'slug' => 'redux-framework',
        'required' => true,
    );
    $plugins[] = array(
        'name' => esc_html__('JP Widget Visibility', 'brixes'),
        'slug' => 'jetpack-widget-visibility',
    );
    $plugins[] = array(
        'name' => esc_html__('WP-LESS', 'brixes'),
        'slug' => 'wp-less',
    );

    $plugins = apply_filters('azexo_plugins', $plugins);
    if (!empty($plugins)) {
        tgmpa($plugins, array());
    }
}

add_action('tgmpa_register', 'azexo_tgmpa_register');
