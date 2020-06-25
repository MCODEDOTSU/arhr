<?php

add_action('pt-ocdi/before_content_import_execution', 'azexo_ocdi_before_import', 10, 3);

function azexo_ocdi_before_import($import_files, $predefined_import_files, $predefined_index) {
    $demo = $predefined_import_files[$predefined_index];
    if (isset($demo['options_url'])) {
        $response = wp_remote_get($demo['options_url']);
        if (is_array($response)) {
            $options = json_decode($response['body'], true);
            if (is_array($options)) {
                foreach ($options as $name => $option) {
                    update_option($name, $option);
                }
            }
        }
    }
}

function azexo_ocdi_set_sidebar_azh_widget($widget_url, $sidebar) {
    $response = wp_remote_get($widget_url);
    if (is_array($response)) {
        $html = azh_uri_replace($response['body']);
        $azh_wxr_importer_url_remap = get_option('azh_wxr_importer_url_remap', array());
        $html = str_replace(array_keys($azh_wxr_importer_url_remap), $azh_wxr_importer_url_remap, $html);

        if (!preg_match('/ data-section=[\'"]([^\'"]+)[\'"]/i', $html)) {
            $html = '<div data-section="header">' . $html . '</div>';
        }
        $parts = parse_url($widget_url);
        $post_id = azexo_create_azh_widget(str_replace('.html', '', basename($parts["path"])), $html);
        if ($post_id) {
            azexo_clear_sidebar($sidebar);
            azexo_pre_set_widget($sidebar, 'azh_widget', array('post' => $post_id));
            return true;
        }
    }
    return false;
}

add_action('pt-ocdi/after_all_import_execution', 'azexo_ocdi_after_import', 10, 3);

function azexo_ocdi_after_import($import_files, $predefined_import_files, $predefined_index) {
    $demo = $predefined_import_files[$predefined_index];
    $header_footer = false;
    if (isset($demo['sidebar_url'])) {
        if (azexo_ocdi_set_sidebar_azh_widget($demo['sidebar_url'], 'sidebar')) {
            $header_footer = true;
        }
    }
    if (isset($demo['header_url'])) {
        if (azexo_ocdi_set_sidebar_azh_widget($demo['header_url'], 'header_sidebar')) {
            $header_footer = true;
        }
    }
    if (isset($demo['canvas_header_url'])) {
        if (azexo_ocdi_set_sidebar_azh_widget($demo['canvas_header_url'], 'azh_header')) {
            $header_footer = true;
        }
    }
    if (isset($demo['footer_url'])) {
        if (azexo_ocdi_set_sidebar_azh_widget($demo['footer_url'], 'footer_sidebar')) {
            $header_footer = true;
        }
    }
    if (isset($demo['canvas_footer_url'])) {
        if (azexo_ocdi_set_sidebar_azh_widget($demo['canvas_footer_url'], 'azh_footer')) {
            $header_footer = true;
        }
    }
    if ($header_footer) {
        $options = get_option(AZEXO_FRAMEWORK);
        $options['header'] = array();
        $options['show_page_title'] = false;
        update_option(AZEXO_FRAMEWORK, $options);
        update_option('azexo_header_footer_installed', true);
    }

    $home = get_page_by_title('Home');
    if (is_object($home)) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);
    }
    $blog = null;
    foreach (array('Blog', 'News', 'Journal') as $title) {
        $blog = get_page_by_title($title);
        if (is_object($blog)) {
            break;
        }
    }
    if (is_object($blog)) {
        update_option('show_on_front', 'page');
        update_option('page_for_posts', $blog->ID);
    }
}
