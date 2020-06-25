<?php
/*
  ReduxFramework Config File
 */

if (!class_exists('AZEXO_Redux_Framework')) {

    class AZEXO_Redux_Framework {

        public $args = array();
        public $sections = array();
        public $theme;
        public static $redux_framework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            add_action('init', array($this, 'initSettings'), 11); // after woocommerce.php
        }

        public function initSettings() {
            $this->theme = wp_get_theme();
            $this->setArguments();
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            add_action('redux/loaded', array($this, 'remove_demo'));
            add_filter('redux/options/' . $this->args['opt_name'] . '/args', array($this, 'change_arguments'));
            AZEXO_Redux_Framework::$redux_framework = new ReduxFramework($this->sections, $this->args);
        }

        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        function remove_demo() {
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'brixes'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'brixes'); ?>" />
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'brixes'); ?>" />
                <?php endif; ?>

                <h4><?php print esc_html($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'brixes'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'brixes'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'brixes') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php print esc_html($this->theme->display('Description')); ?></p>
                    <?php
                    if ($this->theme->parent()) {
                        printf(' <p class="howto">' . wp_kses(__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'brixes'), array('a' => array('href' => array()))) . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'brixes'), $this->theme->parent()->display('Name'));
                    }
                    ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $options = get_option(AZEXO_FRAMEWORK);
            $azexo_templates = azexo_get_templates();

            global $azexo_fields;
            if (!isset($azexo_fields)) {
                $azexo_fields = array();
            }
            global $azexo_post_fields;
            $azexo_post_fields = array(
                'post_title' => esc_html__('Post title', 'brixes'),
                'post_summary' => esc_html__('Post summary', 'brixes'),
                'post_content' => esc_html__('Post content', 'brixes'),
                'post_thumbnail' => esc_html__('Post thumbnail', 'brixes'),
                'post_video' => esc_html__('Post video', 'brixes'),
                'post_gallery' => esc_html__('Post gallery', 'brixes'),
                'post_sticky' => esc_html__('Post sticky', 'brixes'),
                'post_date' => esc_html__('Post date', 'brixes'),
                'post_splitted_date' => esc_html__('Post splitted date', 'brixes'),
                'post_author' => esc_html__('Post author', 'brixes'),
                'post_author_avatar' => esc_html__('Post author avatar', 'brixes'),
                'post_category' => esc_html__('Post category', 'brixes'),
                'post_tags' => esc_html__('Post tags', 'brixes'),
                'post_like' => esc_html__('Post like', 'brixes'),
                'post_last_comment' => esc_html__('Post last comment', 'brixes'),
                'post_last_comment_author' => esc_html__('Post last comment author', 'brixes'),
                'post_last_comment_author_avatar' => esc_html__('Post last comment author avatar', 'brixes'),
                'post_last_comment_date' => esc_html__('Post last comment date', 'brixes'),
                'post_comments_count' => esc_html__('Post comments count', 'brixes'),
                'post_read_more' => esc_html__('Post read more link', 'brixes'),
                'post_share' => esc_html__('Post social share', 'brixes'),
                'post_comments' => esc_html__('Post comments', 'brixes'),
                'post_navigation' => esc_html__('Post navigation', 'brixes'),
            );

            $azexo_fields = array_merge($azexo_fields, $azexo_post_fields);


            $field_templates = azexo_get_field_templates();
            $azexo_fields = array_merge($azexo_fields, $field_templates);


            $taxonomy_fields = array();
            $taxonomies = get_taxonomies(array(), 'objects');
            foreach ($taxonomies as $slug => $taxonomy) {
                $taxonomy_fields['taxonomy_' . $slug] = esc_html__('Taxonomy: ', 'brixes') . $taxonomy->label;
            }
            $azexo_fields = array_merge($azexo_fields, $taxonomy_fields);

            $meta_fields = array();
            if (isset($options['meta_fields']) && is_array($options['meta_fields'])) {
                $options['meta_fields'] = array_filter($options['meta_fields']);
                if (!empty($options['meta_fields'])) {
                    $meta_fields = array_combine($options['meta_fields'], $options['meta_fields']);
                }
            }
            $azexo_fields = array_merge($azexo_fields, $meta_fields);


            $azexo_fields = apply_filters('azexo_fields', $azexo_fields);

            $vc_widgets = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'vc_widget',
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
            ));
            if (is_array($vc_widgets)) {
                foreach ($vc_widgets as $vc_widget) {
                    $azexo_fields[$vc_widget->ID] = $vc_widget->post_title . ' ' . esc_html__('VC Widget', 'brixes');
                }
            }
            $azh_widgets = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'azh_widget',
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
            ));
            if (is_array($azh_widgets)) {
                foreach ($azh_widgets as $azh_widget) {
                    $azexo_fields[$azh_widget->ID] = $azh_widget->post_title . ' ' . esc_html__('AZH Widget', 'brixes');
                }
            }
            $pages = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'page',
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC',
            ));
            $pages_options = array();
            if (is_array($pages)) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }


            $general_settings_fields = array();
            $general_settings_fields[] = array(
                'id' => 'framework_confirmation',
                'type' => 'checkbox',
                'title' => esc_html__('Framework use confirmation', 'brixes'),
                'description' => esc_html__('Almost all settings (including VC elements) in admin-interface of theme used as part of development framework - it allow to make HTML/JS output with high flexibility. It is complex to make CSS theme styles to cover such a big freedom fully. Many possible settings/configurations which not provided with demo content must be used with LESS/CSS sources editing.', 'brixes'),
                'default' => '0'
            );
            $general_settings_fields[] = array(
                'id' => 'logo',
                'type' => 'media',
                'title' => esc_html__('Logo', 'brixes'),
                'subtitle' => esc_html__('Upload any media using the WordPress native uploader', 'brixes'),
                'required' => array('header', 'contains', 'logo')
            );
            if (class_exists('WPLessPlugin')) {
                $general_settings_fields[] = array(
                    'id' => 'brand-color',
                    'type' => 'color',
                    'title' => esc_html__('Brand color', 'brixes'),
                    'validate' => 'color',
                    'default' => '#000',
                );
                $general_settings_fields[] = array(
                    'id' => 'accent-1-color',
                    'type' => 'color',
                    'title' => esc_html__('Accent 1 color', 'brixes'),
                    'validate' => 'color',
                    'default' => '#000',
                );
                $general_settings_fields[] = array(
                    'id' => 'accent-2-color',
                    'type' => 'color',
                    'title' => esc_html__('Accent 2 color', 'brixes'),
                    'validate' => 'color',
                    'default' => '#000',
                );
                $general_settings_fields[] = array(
                    'id' => 'header-color',
                    'type' => 'color',
                    'title' => esc_html__('Header color', 'brixes'),
                    'validate' => 'color',
                    'default' => '#000',
                );
                $general_settings_fields[] = array(
                    'id' => 'paragraph-color',
                    'type' => 'color',
                    'title' => esc_html__('Paragraph color', 'brixes'),
                    'validate' => 'color',
                    'default' => '#000',
                );
            }
            global $azh_google_fonts;
            $general_settings_fields[] = array(
                'id' => 'google_font_families',
                'type' => 'select',
                'multi' => true,
                'sortable' => true,
                'title' => esc_html__('Google font families', 'brixes'),
                'options' => array_combine($azh_google_fonts, $azh_google_fonts),
            );
            if (class_exists('Infinite_Scroll')) {
                $general_settings_fields[] = array(
                    'id' => 'infinite_scroll',
                    'type' => 'checkbox',
                    'title' => esc_html__('Infinite Scroll', 'brixes'),
                    'default' => '0'
                );
            }
            $general_settings_fields[] = array(
                'id' => 'single_post_template',
                'type' => 'select',
                'title' => esc_html__('Single blog template', 'brixes'),
                'options' => $azexo_templates,
                'default' => 'post',
            );
            $general_settings_fields[] = array(
                'id' => 'default_post_template',
                'type' => 'select',
                'title' => esc_html__('Default blog template', 'brixes'),
                'options' => $azexo_templates,
                'default' => 'post',
            );
            $general_settings_fields[] = array(
                'id' => 'show_sidebar',
                'type' => 'select',
                'title' => esc_html__('Show sidebar', 'brixes'),
                'options' => array(
                    'hidden' => esc_html__('Hidden', 'brixes'),
                    'left' => esc_html__('Left side', 'brixes'),
                    'right' => esc_html__('Right side', 'brixes'),
                ),
                'default' => 'right',
            );
            $general_settings_fields[] = array(
                'id' => 'custom-js',
                'type' => 'ace_editor',
                'title' => esc_html__('JS Code', 'brixes'),
                'subtitle' => esc_html__('Paste your JS code here.', 'brixes'),
                'mode' => 'javascript',
                'theme' => 'chrome',
                'default' => "jQuery(document).ready(function(){\n\n});"
            );

            $general_settings_fields[] = array(
                'id' => 'custom_dashboard_pages',
                'type' => 'select',
                'multi' => true,
                'sortable' => true,
                'title' => esc_html__('Custom dashboard pages', 'brixes'),
                'options' => $pages_options,
            );

            if (is_child_theme()) {
                $skin = get_stylesheet();
            } else {
                $skin = get_template();
            }        
            $skins = function_exists('azexo_get_skins') ? azexo_get_skins() : array(isset($options['skin']) ? $options['skin'] : $skin);

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General settings', 'brixes'),
                'fields' => $general_settings_fields
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $post_types = get_post_types(array('_builtin' => false, 'publicly_queryable' => true), 'objects');
            if (is_array($post_types) && !empty($post_types)) {
                $this->sections[] = array(
                    'icon' => 'el-icon-cogs',
                    'title' => esc_html__('Post types settings', 'brixes'),
                );
                foreach ($post_types as $slug => $post_type) {
                    $fields = array(
                        array(
                            'id' => 'single_' . $slug . '_template',
                            'type' => 'select',
                            'title' => esc_html__('Single template', 'brixes'),
                            'options' => $azexo_templates,
                            'default' => $slug,
                        ),
                        array(
                            'id' => 'default_' . $slug . '_template',
                            'type' => 'select',
                            'title' => esc_html__('Default template', 'brixes'),
                            'options' => $azexo_templates,
                            'default' => $slug,
                        ),
                        array(
                            'id' => $slug . '_show_sidebar',
                            'type' => 'select',
                            'title' => esc_html__('Show sidebar', 'brixes'),
                            'options' => array(
                                'hidden' => esc_html__('Hidden', 'brixes'),
                                'left' => esc_html__('Left side', 'brixes'),
                                'right' => esc_html__('Right side', 'brixes'),
                            ),
                            'default' => 'hidden',
                        ),
                        array(
                            'id' => $slug . '_additional_sidebar',
                            'type' => 'select',
                            'multi' => true,
                            'title' => esc_html__('Show additional sidebar', 'brixes'),
                            'options' => array(
                                'single' => esc_html__('Single page', 'brixes'),
                                'list' => esc_html__('List page', 'brixes'),
                            ),
                            'default' => '',
                        ),
                    );
                    if ($slug != 'product') {
                        $fields = array_merge($fields, array(array(
                                'id' => $slug . '_before_list',
                                'type' => 'select',
                                'multi' => true,
                                'sortable' => true,
                                'title' => esc_html__('Before posts list', 'brixes'),
                                'options' => array(
                                    'result_count' => esc_html__('Result count', 'brixes'),
                                    'ordering' => esc_html__('Ordering', 'brixes'),
                                ),
                                'default' => array(),
                            ),
                            array(
                                'id' => $slug . '_custom_sorting',
                                'type' => 'select',
                                'multi' => true,
                                'sortable' => true,
                                'title' => esc_html__('Custom sorting', 'brixes'),
                                'options' => array(
                                    'menu_order' => esc_html__('Default sorting', 'brixes'),
                                    'date' => esc_html__('Sort by newness', 'brixes'),
                                ),
                                'default' => array('menu_order', 'date'),
                            ),
                            array(
                                'id' => $slug . '_custom_sorting_numeric_meta_keys',
                                'type' => 'multi_text',
                                'title' => esc_html__('Custom sorting numeric meta keys', 'brixes'),
                            ),
                        ));
                    }
                    $this->sections[] = array(
                        'icon' => 'el-icon-cogs',
                        'subsection' => true,
                        'title' => $post_type->label,
                        'fields' => $fields
                    );
                }
            }

            $header_parts = array(
                'logo' => esc_html__('Logo', 'brixes'),
                'search' => esc_html__('Search', 'brixes'),
                'primary_menu' => esc_html__('Primary menu', 'brixes'),
                'secondary_menu' => esc_html__('Secondary menu', 'brixes'),
                'mobile_menu_button' => esc_html__('Mobile menu button', 'brixes'),
                'mobile_menu' => esc_html__('Mobile menu', 'brixes'),
            );
            $files = scandir(get_template_directory() . '/template-parts');
            if (is_array($files)) {
                foreach ($files as $file) {
                    $matches = array();
                    if (preg_match('/header\-([\w\-]+)\.php/', $file, $matches)) {
                        $header_parts[$matches[1]] = $matches[0];
                    }
                }
            }

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('Templates configuration', 'brixes'),
                'fields' => array(
                    array(
                        'id' => 'skin',
                        'type' => 'select',
                        'title' => esc_html__('Select skin', 'brixes'),
                        'options' => array_combine($skins, $skins),
                    ),
                    array(
                        'id' => 'header_sidebar_fullwidth',
                        'type' => 'checkbox',
                        'title' => esc_html__('Header sidebar fullwidth', 'brixes'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'header_parts_fullwidth',
                        'type' => 'checkbox',
                        'title' => esc_html__('Header parts fullwidth', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'middle_sidebar_fullwidth',
                        'type' => 'checkbox',
                        'title' => esc_html__('Middle sidebar fullwidth', 'brixes'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'content_fullwidth',
                        'type' => 'checkbox',
                        'title' => esc_html__('Content fullwidth', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'footer_sidebar_fullwidth',
                        'type' => 'checkbox',
                        'title' => esc_html__('Footer sidebar fullwidth', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'show_page_title',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show page title in templates', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'show_breadcrumbs',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show breadcrumb in templates', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'header',
                        'type' => 'select',
                        'multi' => true,
                        'sortable' => true,
                        'title' => esc_html__('Header parts', 'brixes'),
                        'options' => $header_parts,
                        'default' => array(),
                    ),
                    array(
                        'id' => 'author_bio',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show author bio in templates', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'post_navigation',
                        'type' => 'select',
                        'title' => esc_html__('Post navigation place', 'brixes'),
                        'options' => array(
                            'hidden' => esc_html__('Hidden', 'brixes'),
                            'before' => esc_html__('Before content', 'brixes'),
                            'after' => esc_html__('After content', 'brixes'),
                        ),
                        'default' => 'hidden',
                    ),
                    array(
                        'id' => 'post_navigation_full',
                        'type' => 'checkbox',
                        'title' => esc_html__('Post navigation full template', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'post_navigation_previous',
                        'type' => 'text',
                        'title' => esc_html__('Post navigation previous text', 'brixes'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'post_navigation_next',
                        'type' => 'text',
                        'title' => esc_html__('Post navigation next text', 'brixes'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'related_posts',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show related posts', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'comments',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show comments in templates', 'brixes'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'comment_likes',
                        'type' => 'checkbox',
                        'title' => esc_html__('Show likes in comment', 'brixes'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'default_title',
                        'type' => 'text',
                        'title' => esc_html__('Default page title', 'brixes'),
                        'default' => 'Latest posts',
                    ),
                    array(
                        'id' => 'post_page_title',
                        'type' => 'select',
                        'title' => esc_html__('Post page title', 'brixes'),
                        'options' => $azexo_fields,
                        'default' => '',
                    ),
                    array(
                        'id' => 'strip_excerpt',
                        'type' => 'checkbox',
                        'title' => esc_html__('Strip excerpt', 'brixes'),
                        'default' => '1',
                    ),
                    array(
                        'id' => 'excerpt_length',
                        'type' => 'text',
                        'title' => esc_html__('Excerpt length', 'brixes'),
                        'default' => '15',
                    ),
                    array(
                        'id' => 'comment_excerpt_length',
                        'type' => 'text',
                        'title' => esc_html__('Comment excerpt length', 'brixes'),
                        'default' => '15',
                    ),
                    array(
                        'id' => 'author_avatar_size',
                        'type' => 'text',
                        'title' => esc_html__('Author avatar size', 'brixes'),
                        'default' => '100',
                    ),
                    array(
                        'id' => 'avatar_size',
                        'type' => 'text',
                        'title' => esc_html__('Avatar size', 'brixes'),
                        'default' => '60',
                    ),
                    array(
                        'id' => 'related_posts_carousel_margin',
                        'type' => 'text',
                        'title' => esc_html__('Related posts carousel margin', 'brixes'),
                        'default' => '0',
                    ),
                    array(
                        'id' => 'before_list_place',
                        'type' => 'select',
                        'title' => esc_html__('Before posts place', 'brixes'),
                        'options' => array(
                            'inside_content_area' => esc_html__('Inside content area', 'brixes'),
                            'before_container' => esc_html__('Before container', 'brixes'),
                        ),
                        'default' => 'inside_content_area',
                    ),
                    array(
                        'id' => 'templates',
                        'type' => 'multi_text',
                        'title' => esc_html__('Templates', 'brixes'),
                    ),
                    array(
                        'id' => 'meta_fields',
                        'type' => 'multi_text',
                        'title' => esc_html__('Meta fields', 'brixes'),
                    ),
                )
            );

            foreach ($azexo_templates as $template_slug => $template_name) {


                $places = array(
                    $template_slug . '_thumbnail' => esc_html__('Thumbnail DIV', 'brixes'),
                    $template_slug . '_hover' => esc_html__('Thumbnail hover DIV', 'brixes'),
                    $template_slug . '_extra' => esc_html__('Header extra DIV', 'brixes'),
                    $template_slug . '_meta' => esc_html__('Header meta DIV', 'brixes'),
                    $template_slug . '_header' => esc_html__('Header DIV', 'brixes'),
                    $template_slug . '_footer' => esc_html__('Footer DIV', 'brixes'),
                    $template_slug . '_data' => esc_html__('Data DIV', 'brixes'),
                    $template_slug . '_additions' => esc_html__('Additions DIV', 'brixes'),
                    $template_slug . '_next' => esc_html__('Append next', 'brixes'),
                );
                $post_fields = array();
                foreach ($places as $id => $name) {
                    $post_fields[] = array(
                        'id' => $id,
                        'type' => 'select',
                        'multi' => true,
                        'sortable' => true,
                        'title' => $name,
                        'options' => $azexo_fields
                    );
                }

                $this->sections[] = array(
                    'icon' => 'el-icon-cogs',
                    'title' => $template_name,
                    'subsection' => true,
                    'fields' => array_merge(array(
                        array(
                            'id' => $template_slug . '_show_thumbnail',
                            'type' => 'checkbox',
                            'title' => esc_html__('Show thumbnail/gallery/video', 'brixes'),
                            'default' => '1'
                        ),
                        array(
                            'id' => $template_slug . '_image_thumbnail',
                            'type' => 'checkbox',
                            'title' => esc_html__('Only image thumbnail (no gallery/video)', 'brixes'),
                            'default' => '0',
                            'required' => array($template_slug . '_show_thumbnail', 'equals', '1')
                        ),
                        array(
                            'id' => $template_slug . '_gallery_slider_thumbnails',
                            'type' => 'checkbox',
                            'title' => esc_html__('Show gallery slider thumbnails', 'brixes'),
                            'default' => '0',
                            'required' => array($template_slug . '_show_thumbnail', 'equals', '1')
                        ),
                        array(
                            'id' => $template_slug . '_gallery_slider_thumbnails_vertical',
                            'type' => 'checkbox',
                            'title' => esc_html__('Vertical gallery slider thumbnails', 'brixes'),
                            'default' => '0',
                            'required' => array($template_slug . '_gallery_slider_thumbnails', 'equals', '1'),
                        ),
                        array(
                            'id' => $template_slug . '_zoom',
                            'type' => 'checkbox',
                            'title' => esc_html__('Zoom image on mouse hover', 'brixes'),
                            'default' => '0',
                            'required' => array($template_slug . '_show_thumbnail', 'equals', '1')
                        ),
                        array(
                            'id' => $template_slug . '_lazy',
                            'type' => 'checkbox',
                            'title' => esc_html__('Lazy load images', 'brixes'),
                            'default' => '0',
                            'required' => array($template_slug . '_show_thumbnail', 'equals', '1')
                        ),
                        array(
                            'id' => $template_slug . '_show_carousel',
                            'type' => 'checkbox',
                            'title' => esc_html__('Show gallery as carousel', 'brixes'),
                            'default' => '0',
                            'required' => array(
                                array($template_slug . '_show_thumbnail', 'equals', '1'),
                                array($template_slug . '_image_thumbnail', '!=', '1')
                            )
                        ),
                        array(
                            'id' => $template_slug . '_thumbnail_size',
                            'type' => 'text',
                            'title' => esc_html__('Thumbnail size', 'brixes'),
                            'default' => 'large',
                            'required' => array($template_slug . '_show_thumbnail', 'equals', '1')
                        ),
                        array(
                            'id' => $template_slug . '_show_title',
                            'type' => 'checkbox',
                            'title' => esc_html__('Show title', 'brixes'),
                            'default' => '1'
                        ),
                        array(
                            'id' => $template_slug . '_show_content',
                            'type' => 'select',
                            'title' => esc_html__('Show content/excerpt', 'brixes'),
                            'options' => array(
                                'hidden' => esc_html__('Hidden', 'brixes'),
                                'content' => esc_html__('Show content', 'brixes'),
                                'excerpt' => esc_html__('Show excerpt', 'brixes'),
                            ),
                            'default' => 'content',
                        ),
                        array(
                            'id' => $template_slug . '_excerpt_length',
                            'type' => 'text',
                            'title' => esc_html__('Excerpt length', 'brixes'),
                            'default' => '15',
                            'required' => array($template_slug . '_show_content', 'equals', 'excerpt')
                        ),
                        array(
                            'id' => $template_slug . '_excerpt_words_trim',
                            'type' => 'checkbox',
                            'title' => esc_html__('Excerpt trim by words', 'brixes'),
                            'default' => '1',
                            'required' => array($template_slug . '_show_content', 'equals', 'excerpt')
                        ),
                        array(
                            'id' => $template_slug . '_more_inside_content',
                            'type' => 'checkbox',
                            'title' => esc_html__('Show more link inside content', 'brixes'),
                            'default' => '1',
                            'required' => array($template_slug . '_show_content', 'equals', 'content')
                        ),
                            ), $post_fields)
                );
            }

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('Fields configuration', 'brixes'),
                'fields' => array()
            );

            foreach ($azexo_fields as $field_slug => $field_name) {
                $fields = array();
                if (isset($taxonomy_fields[$field_slug]) || isset($meta_fields[$field_slug])) {
                    $fields[] = array(
                        'id' => str_replace('.php', '', $field_slug) . '_image',
                        'type' => 'media',
                        'title' => esc_html__('Image', 'brixes'),
                        'default' => '',
                    );
                    $fields[] = array(
                        'id' => str_replace('.php', '', $field_slug) . '_hide_empty',
                        'type' => 'checkbox',
                        'title' => esc_html__('Hide empty', 'brixes'),
                        'default' => '0',
                    );
                }
                $fields[] = array(
                    'id' => str_replace('.php', '', $field_slug) . '_prefix',
                    'type' => 'textarea',
                    'title' => esc_html__('Prefix', 'brixes'),
                    'default' => '',
                );
                if (isset($taxonomy_fields[$field_slug]) || isset($meta_fields[$field_slug])) {
                    $fields[] = array(
                        'id' => str_replace('.php', '', $field_slug) . '_suffix',
                        'type' => 'textarea',
                        'title' => esc_html__('Suffix', 'brixes'),
                        'default' => '',
                    );
                }
                $this->sections[] = array(
                    'icon' => 'el-icon-cogs',
                    'title' => $field_name,
                    'subsection' => true,
                    'fields' => $fields,
                );
            }

            $this->sections = apply_filters('azexo_settings_sections', $this->sections);

            $this->sections[] = array(
                'type' => 'divide',
            );

            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . wp_kses(__('<strong>Theme URL:</strong> ', 'brixes'), array('strong' => array())) . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . wp_kses(__('<strong>Author:</strong> ', 'brixes'), array('strong' => array())) . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . wp_kses(__('<strong>Version:</strong> ', 'brixes'), array('strong' => array())) . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . wp_kses(__('<strong>Tags:</strong> ', 'brixes'), array('strong' => array())) . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'brixes'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'brixes'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon' => 'el-icon-info-sign',
                'title' => esc_html__('Theme Information', 'brixes'),
                'fields' => array(
                    array(
                        'id' => 'raw-info',
                        'type' => 'raw',
                        'content' => $item_info,
                    )
                ),
            );
        }

        public static function getArguments() {
            return array(
                'opt_name' => AZEXO_FRAMEWORK,
                'page_slug' => '_options',
                'page_title' => 'AZEXO Options',
                'update_notice' => true,
                'admin_bar' => false,
                'menu_type' => 'menu',
                'menu_title' => 'AZEXO Options',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_mark' => '*',
                'hints' =>
                array(
                    'icon' => 'el-icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' =>
                    array(
                        'color' => 'light',
                    ),
                    'tip_position' =>
                    array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' =>
                    array(
                        'show' =>
                        array(
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' =>
                        array(
                            'duration' => '500',
                            'event' => 'mouseleave unfocus',
                        ),
                    ),
                ),
                'output' => true,
                'output_tag' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
            );
        }

        public function setArguments() {

            $this->args = AZEXO_Redux_Framework::getArguments();

            $theme = wp_get_theme();
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");
        }

    }

    global $azexo_redux_config;
    $azexo_redux_config = new AZEXO_Redux_Framework();
}

add_action('update_option_' . AZEXO_FRAMEWORK, 'update_azexo_options', 10, 3);

function update_azexo_options($old_value, $value, $option) {
    if (isset($value['favicon']) && !empty($value['favicon']) && isset($value['favicon']['id']) && !empty($value['favicon']['id'])) {
        update_option('site_icon', $value['favicon']['id']);
    }
}
