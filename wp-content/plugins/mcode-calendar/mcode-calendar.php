<?php
/*
	Plugin Name: MCode Calendar
	Author: Sirotkina Aliona (info@mcode.su)
	Author URI: http://mcode.su/
*/

function mcode_calendar_styles()
{
    wp_register_script('mcode_calendar_script', plugins_url('/script.js', __FILE__), array('jquery'), date('His'));
    wp_enqueue_script('mcode_calendar_script');
    wp_localize_script('mcode_calendar_script', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);
    wp_register_style('mcode_calendar_styles', plugins_url('/style.css', __FILE__), array(), date('His'));
    wp_enqueue_style('mcode_calendar_styles');
}

add_action('wp_enqueue_scripts', 'mcode_calendar_styles');

if (is_admin()) {
    add_action('admin_menu', 'mcode_calendar_init');
}

function mcode_calendar_init()
{

    add_menu_page(__('Calendar', 'mcode-calendar'), __('Calendar', 'mcode-calendar'), 'manage_options', 'mcode_calendar-menu', 'mcode_calendar_page', 'dashicons-schedule', 82);
}

function mcode_calendar_page()
{

    if (isset($_POST["submit"])) {
        if (isset($_POST["mcode_calendar_field_start"])) update_option('mcode_calendar_field_start', $_POST['mcode_calendar_field_start']);
        if (isset($_POST["mcode_calendar_field_finish"])) update_option('mcode_calendar_field_finish', $_POST['mcode_calendar_field_finish']);
        if (isset($_POST["mcode_calendar_category"])) update_option('mcode_calendar_category', $_POST['mcode_calendar_category']);
    }

    $categories = get_categories();

    $mcode_calendar_field_start = get_option('mcode_calendar_field_start');
    $mcode_calendar_field_finish = get_option('mcode_calendar_field_finish');
    $mcode_calendar_category = get_option('mcode_calendar_category');

    require_once('page.php');

}

/***
 * Получить календарь в формате "дни-месяц"
 * @param $count
 * @return string
 */
function mcode_calendar_get_days_month_calendar($count)
{
    $html = '<div class="mcode_calendar-days_month"><div class="tabs"><a href="#days" class="tab days current">' .
        __('Days', 'mcode-calendar') .
        '</a><a  href="#month" class="tab month">' .
        __('Month', 'mcode-calendar') . '</a></div><div data-name="#days" class="tab-content visibility">';

    $posts = mcode_calendar_get_future_events($count);

    // Текущее и будующие мероприятия
    if (count($posts) != 0) {

        foreach ($posts as $post) {

            $event_class = date('d.m.Y', strtotime($post['start'])) == date('d.m.Y') ? 'today' : 'feature';
            $date = get_locale() == 'ru_RU' ? date('d.m.Y', strtotime($post['start'])) : date('Y-m-d', strtotime($post['start']));
            $html .= "<a class='event-item $event_class' href='{$post['permalink']}'><span class='date-start'>{$date}</span><h2>{$post['title']}</h2></a>";

        }
    }

    // Прошедшие мероприятия
    if (count($posts) < $count) {

        $posts = mcode_calendar_get_past_events($count - count($posts));

        if (count($posts) != 0) {

            foreach ($posts as $post) {

                $date = get_locale() == 'ru_RU' ? date('d.m.Y', strtotime($post['start'])) : date('Y-m-d', strtotime($post['start']));
                $event_class = date('m', strtotime($post['start'])) != date('m') ? 'old' : 'past';
                $html .= "<a class='event-item $event_class' href='{$post['permalink']}'><span class='date-start'>{$date}</span><h2>{$post['title']}</h2></a>";

            }
        }

    }

    $html .= '</div><div data-name="#month" class="tab-content">';

    $html .= mcode_calendar_get_grid(date('n'), date('Y'));

    $html .= '</div></div>';

    return $html;
}

/**
 * Получить полный календарь на заданный месяц
 * @param $month
 * @param $year
 * @return string
 */
function mcode_calendar_get_full_calendar($month, $year)
{

    $mcode_calendar_months = [
        __('January', 'mcode-calendar'),
        __('February', 'mcode-calendar'),
        __('March', 'mcode-calendar'),
        __('April', 'mcode-calendar'),
        __('May', 'mcode-calendar'),
        __('June', 'mcode-calendar'),
        __('July', 'mcode-calendar'),
        __('August', 'mcode-calendar'),
        __('September', 'mcode-calendar'),
        __('October', 'mcode-calendar'),
        __('November', 'mcode-calendar'),
        __('December', 'mcode-calendar'),
    ];

    $section = get_option('mcode_calendar_category');
    $field = get_option('mcode_calendar_field_start');

    $html = "<div class='mcode_calendar-full'>";

    $html .= "<div class='actions'>
                    <div class='month' data-item='$month'>
                        <button class='btn prev'><i class='fa fa-angle-left'></i></button>
                        <span class='i'>{$mcode_calendar_months[$month - 1]}</span>
                        <button class='btn next'><i class='fa fa-angle-right'></i></button>
                    </div>
                    <div class='year' data-item='$year'>
                        <button class='btn prev'><i class='fa fa-angle-left'></i></button>
                        <span class='i'>{$year}</span>
                        <button class='btn next'><i class='fa fa-angle-right'></i></button>
                    </div>
                </div>";

    $html .= mcode_calendar_get_grid($month, $year);

    $html .= '</div>';

    return $html;

}

/***
 * Получить все меропрития
 * @param int $count
 * @return array
 */
function mcode_calendar_get_events($count = 10)
{

    $section = get_option('mcode_calendar_category');
    $field = get_option('mcode_calendar_field_start');

    if (pll_current_language() != pll_get_term_language($section)) {
        $section = pll_get_term($section, pll_current_language());
    }

    $query = new WP_Query([
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'cat' => $section,
        'meta_query' => [
            [
                'key' => $field,
                'compare' => '!=',
                'value' => ''
            ],
        ],
        'orderby' => 'meta_value_num',
        'meta_key' => $field,
        'order' => 'ASC'
    ]);

    $result = [];

    while ($query->have_posts()) {

        $query->the_post();

        $result[] = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'permalink' => get_permalink(get_the_ID()),
            'start' => get_post_meta(get_the_ID(), $field, true),
            'finish' => get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true),
            'start_tm' => strtotime(get_post_meta(get_the_ID(), $field, true)),
            'finish_tm' => strtotime(get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true)),
        ];

    }
    wp_reset_postdata();

    return $result;
}

/***
 * Получить все меропрития в будущем
 * @param int $count
 * @return array
 */
function mcode_calendar_get_future_events($count = 10)
{

    $section = get_option('mcode_calendar_category');
    $field = get_option('mcode_calendar_field_start');

    if (pll_current_language() != pll_get_term_language($section)) {
        $section = pll_get_term($section, pll_current_language());
    }

    $query = new WP_Query([
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'cat' => $section,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => $field,
                'compare' => '>=',
                'value' => date('Y-m-d 00:00:00')
            ],
            [
                'key' => $field,
                'compare' => '!=',
                'value' => ''
            ],
        ],
        'orderby' => 'meta_value_num',
        'meta_key' => $field,
        'order' => 'ASC'
    ]);

    $result = [];

    while ($query->have_posts()) {

        $query->the_post();

        $result[] = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'permalink' => get_permalink(get_the_ID()),
            'start' => get_post_meta(get_the_ID(), $field, true),
            'finish' => get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true),
            'start_tm' => strtotime(get_post_meta(get_the_ID(), $field, true)),
            'finish_tm' => strtotime(get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true)),
        ];

    }
    wp_reset_postdata();

    return $result;
}

/***
 * Получить все меропрития в прошлом
 * @param int $count
 * @return array
 */
function mcode_calendar_get_past_events($count = 10)
{

    $section = get_option('mcode_calendar_category');
    $field = get_option('mcode_calendar_field_start');

    if (pll_current_language() != pll_get_term_language($section)) {
        $section = pll_get_term($section, pll_current_language());
    }

    $query = new WP_Query([
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'cat' => $section,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => $field,
                'compare' => '<',
                'value' => date('Y-m-d 00:00:00')
            ],
            [
                'key' => $field,
                'compare' => '!=',
                'value' => ''
            ],
        ],
        'orderby' => 'meta_value_num',
        'meta_key' => $field,
        'order' => 'DESC'
    ]);

    $result = [];

    while ($query->have_posts()) {

        $query->the_post();

        $result[] = [
            'title' => get_the_title(),
            'excerpt' => get_the_excerpt(),
            'permalink' => get_permalink(get_the_ID()),
            'start' => get_post_meta(get_the_ID(), $field, true),
            'finish' => get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true),
            'start_tm' => strtotime(get_post_meta(get_the_ID(), $field, true)),
            'finish_tm' => strtotime(get_post_meta(get_the_ID(), get_option('mcode_calendar_field_finish'), true)),
        ];

    }
    wp_reset_postdata();

    return $result;
}

/***
 * Генерация сетки календаря
 * @param $month
 * @param $year
 * @return string
 */
function mcode_calendar_get_grid($month, $year)
{

    $events = mcode_calendar_get_events();

    $day = date('w', mktime(0, 0, 0, $month, 1, $year)) - 1;
    $day = $day == -1 ? 6 : $day;

    $calendar = "<table cellpadding='0' cellspacing='0' class='calendar-grid'>
                    <tbody>
                        <tr class='row'>";

    // Предыдущий месяц
    $date = new DateTime("$year-$month-1");
    $date->modify('-' . ($day + 1) . ' day');
    for ($i = 0; $i < $day; $i++) {
        $date->modify('+1 day');
        $calendar .= mcode_calendar_get_cell($date, $events, 'previous');
    }

    // Текущий месяц
    $count = date('t', mktime(0, 0, 0, $month, 1, $year));
    for ($i = 1; $i <= $count; $i++) {
        $calendar .= mcode_calendar_get_cell(new DateTime("$year-$month-$i"), $events) . ($day == 6 ? "</tr><tr>" : "");
        $day = ($day + 1) % 7;
    }

    // Следующий месяц
    if ($day != 0) {
        $date = $month != 12 ? new DateTime("$year-" . ($month + 1) . "-1") : new DateTime(($year + 1) . "-1-1");
        for ($i = 7; $i > $day; $i--) {
            $calendar .= mcode_calendar_get_cell($date, $events, 'next') . (($i - $day) == 1 ? "</tr>" : "");
            $date->modify('+1 day');
        }
    }

    $calendar .= "</tbody></table>";

    return $calendar;
}

/**
 * Сформировать ячейку календаря
 * @param $date
 * @param array $events
 * @param $period_class
 * @return string
 */
function mcode_calendar_get_cell($date, $events = [], $period_class = "")
{

    $day = (int)date_format($date, 'd');
    $format_date = date('Y-m-d', mktime(0, 0, 0, date_format($date, 'm'), $day, date_format($date, 'Y')));

    $events = array_values(array_filter($events, function($item) use ($format_date) {
        return (date('Y-m-d', $item['start_tm']) == $format_date);
    }));

    $has_events_class = empty($events) ? '' : 'event';
    $current_day_class = date('Y-m-d') == $format_date ? 'current' : '';

    $section = get_option('mcode_calendar_category');
    if (pll_current_language() != pll_get_term_language($section)) {
        $section = pll_get_term($section, pll_current_language());
    }
    $category = get_category($section);

    $eventsCount = !wp_is_mobile() ? count($events) - 1 : count($events);

    $cell = "<td class='day $period_class $has_events_class $current_day_class'>" . ( empty($events) ? $day :
            "<form action='{$category->slug}' method='POST' title='" . __('Event list', 'mcode-calendar') . "'>
                <input type='hidden' name='date' value='$format_date'/>$day                
                <div class='event-title'>{$events[0]['title']}</div>" .
                ($eventsCount == 0 ? '' : "<span class='event-count'>+$eventsCount</span>") .
            "</form>" ) . "</td>";

    return $cell;
}

/***
 * AJAX
 */
function mcode_calendar_get_callback()
{
    $month = (int)$_POST['month'];
    $year = (int)$_POST['year'];

    if (!is_int($month) || !is_int($year)) {
        echo json_encode(['error' => 'not valid data type']);
    } elseif ($month < 1 || $month > 12 || $year < 2018 || $year > 2100) {
        echo json_encode(['error' => 'not valid value']);
    } else {
        echo json_encode(['html' => mcode_calendar_get_full_calendar($month, $year)]);
    }
    wp_die();
}

add_action('wp_ajax_mcode_calendar_get', 'mcode_calendar_get_callback');
add_action('wp_ajax_nopriv_mcode_calendar_get', 'mcode_calendar_get_callback');

/**
 * LANGUAGES
 */
function mcode_calendar_load_plugin_textdomain()
{
    load_plugin_textdomain('mcode-calendar', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

add_action('plugins_loaded', 'mcode_calendar_load_plugin_textdomain');