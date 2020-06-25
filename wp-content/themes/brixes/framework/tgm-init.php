<?php

function azexo_tgmpa_register() {

    $plugins = array();
    if (file_exists(get_template_directory() . '/plugins/mynx-page-builder.zip')) {
        $plugins[] = array(
            'name' => esc_html__('Core theme plugin', 'brixes'),
            'slug' => 'mynx-page-builder',
            'source' => get_template_directory() . '/plugins/mynx-page-builder.zip',
            'required' => true,
            'version' => '1.27.8',
        );
    }
    $plugins[] = array(
        'name' => esc_html__('Redux Framework', 'brixes'),
        'slug' => 'redux-framework',
        'required' => true,
    );
    $plugins[] = array(
        'name' => esc_html__('Cost Calculator by AZEXO', 'brixes'),
        'slug' => 'cost-calculator-by-azexo',
    );
    $plugins[] = array(
        'name' => esc_html__('One click demo import', 'brixes'),
        'slug' => 'one-click-demo-import',
    );
    $plugins[] = array(
        'name' => esc_html__('WP-LESS', 'brixes'),
        'slug' => 'wp-less',
    );

    $plugins = apply_filters('azexo_plugins', $plugins);
    if (!empty($plugins)) {
        tgmpa($plugins, array());
    }


    $additional_plugins = array(
        'jetpack-widget-visibility' => esc_html__('JP Widget Visibility', 'brixes'),
        'vc_widgets' => esc_html__('Visual Composer Widgets', 'brixes'),
        'azexo_vc_elements' => esc_html__('AZEXO Visual Composer elements', 'brixes'),
        'az_social_login' => esc_html__('AZEXO Social Login', 'brixes'),
        'az_email_verification' => esc_html__('AZEXO Email Verification', 'brixes'),
        'az_likes' => esc_html__('AZEXO Post/Comments likes', 'brixes'),
        'az_voting' => esc_html__('AZEXO Voting', 'brixes'),
        'azexo_html' => esc_html__('AZEXO HTML Customizer', 'brixes'),
        'azh_extension' => esc_html__('AZEXO HTML Library', 'brixes'),
        'page-builder-by-azexo' => esc_html__('Page builder by AZEXO', 'brixes'),
        'elements-library-for-azexo-builder' => esc_html__('Elements Library for AZEXO Builder', 'brixes'),
        'az_listings' => esc_html__('AZEXO Listings', 'brixes'),
        'az_query_form' => esc_html__('AZEXO Query Form', 'brixes'),
        'az_group_buying' => esc_html__('AZEXO Group Buying', 'brixes'),
        'az_vouchers' => esc_html__('AZEXO Vouchers', 'brixes'),
        'az_bookings' => esc_html__('AZEXO Bookings', 'brixes'),
        'az_deals' => esc_html__('AZEXO Deals', 'brixes'),
        'az_sport_club' => esc_html__('AZEXO Sport Club', 'brixes'),
        'az_locations' => esc_html__('AZEXO Locations', 'brixes'),
        'circular_countdown' => esc_html__('Circular CountDown', 'brixes'),
    );
    $plugins = array();
    foreach ($additional_plugins as $additional_plugin_slug => $additional_plugin_name) {
        $plugin_path = get_template_directory() . '/plugins/' . $additional_plugin_slug . '.zip';
        if (file_exists($plugin_path)) {
            $plugins[] = array(
                'name' => $additional_plugin_name,
                'slug' => $additional_plugin_slug,
                'source' => $plugin_path,
                'required' => true,
                'version' => AZEXO_FRAMEWORK_VERSION,
            );
        }
    }
    $plugins = apply_filters('azexo_plugins', $plugins);
    if (!empty($plugins)) {
        tgmpa($plugins, array(
        ));
    }
}

add_action('tgmpa_register', 'azexo_tgmpa_register');
