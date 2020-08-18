<?php

function _theme_setting($wp_customize)
{

    #region Индивидуальные настройки

    $wp_customize->add_section(
        'section',
        [
            'title' => 'Title',
            'description' => 'Description',
            'priority' => 10,
        ]
    );

    /* Image */
    $wp_customize->add_setting('setting_image');
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize, 'setting_image',
            [
                'label' => 'Image',
                'section' => 'section',
                'settings' => 'setting_image',
                'height' => 300,
                'width' => 300
            ]
        )
    );

    /* Text */
    $wp_customize->add_setting(
        'setting_text'
    );
    $wp_customize->add_control(
        'setting_text',
        array(
            'label' => 'Title',
            'section' => 'section',
            'type' => 'text',
        )
    );

    /* Select - Options */
    $wp_customize->add_setting(
        'setting_select'
    );
    $wp_customize->add_control(
        'setting_select',
        array(
            'label' => 'Title',
            'section' => 'section',
            'type' => 'select',
            'choices' => [
                'key' => 'value',
            ],
            'default' => 'key',
        )
    );

    /* Number */
    $wp_customize->add_setting(
        'setting_number'
    );
    $wp_customize->add_control(
        'setting_number',
        array(
            'label' => 'Title',
            'section' => 'section',
            'type' => 'number',
            'default' => 1,
            'input_attrs' => [
                'min' => 0,
                'step' => 1,
                'max' => 10
            ]
        )
    );

    /* Color */
    $wp_customize->add_setting(
        'setting_color',
        [
            'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        ]
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'setting_color',
            [
                'label' => 'Title',
                'section' => 'section',
            ]
        )
    );

    /* Texarea */
    $wp_customize->add_setting(
        'setting_textarea'
    );
    $wp_customize->add_control(
        'setting_textarea',
        array(
            'label' => 'Title',
            'section' => 'section',
            'type' => 'textarea',
        )
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