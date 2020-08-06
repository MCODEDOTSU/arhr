<?php

function _theme_setting($wp_customize)
{

    #region Индивидуальные настройки

    $wp_customize->add_section(
        'main_section',
        [
            'title' => 'Общие настройки',
            'description' => 'Общие настройки',
            'priority' => 10,
        ]
    );

    /* Color 1 */
    $wp_customize->add_setting(
        'color_1',
        ['default' => '#fafafa', 'sanitize_callback' => 'sanitize_hex_color']
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'color_1',
            ['label' => 'Цвет #1', 'section' => 'main_section',]
        )
    );

    /* Color 2 */
    $wp_customize->add_setting(
        'color_2',
        ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color']
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'color_2',
            ['label' => 'Цвет #2', 'section' => 'main_section',]
        )
    );

    /* Color 3 */
    $wp_customize->add_setting(
        'color_3',
        ['default' => '#3a85c0', 'sanitize_callback' => 'sanitize_hex_color']
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'color_3',
            ['label' => 'Цвет #3', 'section' => 'main_section',]
        )
    );

    /* Color 4 */
    $wp_customize->add_setting(
        'color_4',
        ['default' => '#222222', 'sanitize_callback' => 'sanitize_hex_color']
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'color_4',
            ['label' => 'Цвет #4', 'section' => 'main_section',]
        )
    );

    /* Max Width */
    $wp_customize->add_setting(
        'max_width'
    );
    $wp_customize->add_control(
        'max_width',
        ['label' => 'Максимальная ширина контента', 'section' => 'main_section', 'type' => 'number', 'default' => 1340, 'input_attrs' => ['min' => 900, 'step' => 10, 'max' => 2400]]
    );

    /* Logo */
    $wp_customize->add_setting('logo_image');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'logo_image',
            [
                'label' => 'Логотип',
                'section' => 'main_section',
                'settings' => 'logo_image',
                'height' => 90,
                'width' => 90
            ]
        )
    );

    /* Site Title [RU] */
    $wp_customize->add_setting('site_title_ru_RU');
    $wp_customize->add_control(
        'site_title_ru_RU',
        ['label' => 'Название сайта [RU]', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Site Title [EN] */
    $wp_customize->add_setting('site_title_en_US');
    $wp_customize->add_control(
        'site_title_en_US',
        ['label' => 'Название сайта [EN]', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Site Description [RU] */
    $wp_customize->add_setting('site_description_ru_RU');
    $wp_customize->add_control(
        'site_description_ru_RU',
        ['label' => 'Описание [RU]', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Site Description [EN] */
    $wp_customize->add_setting('site_description_en_US');
    $wp_customize->add_control(
        'site_description_en_US',
        ['label' => 'Описание [EN]', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Site Title [RU] */
    $wp_customize->add_setting('phone_header');
    $wp_customize->add_control(
        'phone_header',
        ['label' => 'Телефон в шапке', 'section' => 'main_section', 'type' => 'text',]
    );

    /* URL contactform */
    $wp_customize->add_setting('write_link');
    $wp_customize->add_control(
        'write_link',
        ['label' => 'Ссылка (якорь) для кнопки "Написать нам"', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Facebook */
    $wp_customize->add_setting('facebook_link');
    $wp_customize->add_control(
        'facebook_link',
        ['label' => 'Ссылка на Facebook', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Vkontakte */
    $wp_customize->add_setting('vkontakte_link');
    $wp_customize->add_control(
        'vkontakte_link',
        ['label' => 'Ссылка на Vkontakte', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Youtube */
    $wp_customize->add_setting('youtube_link');
    $wp_customize->add_control(
        'youtube_link',
        ['label' => 'Ссылка на Youtube', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Instagram */
    $wp_customize->add_setting('instagram_link');
    $wp_customize->add_control(
        'instagram_link',
        ['label' => 'Ссылка на Instagram', 'section' => 'main_section', 'type' => 'text',]
    );

    /* Linkedin */
    $wp_customize->add_setting('linkedin_link');
    $wp_customize->add_control(
        'linkedin_link',
        ['label' => 'Ссылка на LinkedIn', 'section' => 'main_section', 'type' => 'text',]
    );

    #endregion

}

add_action('customize_register', '_theme_setting');

/***
 * Сделать заданный цвет темнее (для hover)
 * @param $color
 * @param int $value
 * @return string
 */
function getDarketColor($color, $value = 50)
{
    $color = str_replace('#', '', $color);
    $items = str_split($color, 2);
    foreach ($items as &$item) {
        $item = hexdec($item) - $value;
        if ($item < 0) $item = 0;
        $item = dechex($item);
        if (strlen($item) === 1) $item = "0$item";
    }
    return '#' . implode($items);
}

/***
 * Получить абсолютно контрастный цвет от заданного
 * @param $color
 * @return string
 */
function getContrastColor($color)
{
    $color = str_replace('#', '', $color);
    $items = str_split($color, 2);
    foreach ($items as &$item) {
        $item = dechex(255 - hexdec($item));
        if (strlen($item) === 1) $item = "0$item";
    }
    return '#' . implode($items);
}

/***
 * Получить цвет в RGBA
 * @param $color
 * @param bool $opacity
 * @return string
 */
function hex2rgba($color, $opacity = false)
{

    $default = 'rgb(0,0,0)';

    if (empty($color)) {
        return $default;
    }

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    $rgb = array_map('hexdec', $hex);

    if ($opacity) {
        if (abs($opacity) > 1) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    return $output;
}