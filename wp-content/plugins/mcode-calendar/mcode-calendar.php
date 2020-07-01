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

class McodeCalendar extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'mcode_calendar', // Base ID
            __('Calendar of events', 'mcode-calendar'), // Name
            array('description' => __('Building an event calendar based on an additional field in notes', 'mcode-calendar'),) // Args
        );
    }

    public function widget($args, $instance)
    {
        $day = !empty($_POST['date']) ? $_POST['date'] : date('Y-m-d');
        $mount = date('n', strtotime($day));
        $year = date('Y', strtotime($day));

        if (isset($instance['field'])) $field = $instance['field'];
        else $field = 'event_datetime';
        if (isset($instance['section'])) $section = $instance['section'];
        else $section = -1;
        echo "<div class='mcode-calendar' data-field='$field' data-section='$section'>" .
            mcode_calendar($mount, $year, $section, $field) . "</div>" .
            get_future_events($section, $field);
    }

    public function form($instance)
    {
        if (isset($instance['field'])) $field = $instance['field'];
        else $field = 'event_datetime';
        if (isset($instance['section'])) $section = $instance['section'];
        else $section = -1;

        $categories = get_categories();
        $selectCategoryHtml = "";
        foreach ($categories as $c) {
            $selected = $c->cat_ID == $section ? 'selected' : '';
            $selectCategoryHtml .= "<option value='{$c->cat_ID}' {$selected}>{$c->name}</option>";
        }

        ?>
        <p><label><?= __('Category: ', 'mcode-calendar') ?></label></p>
        <p><select name="<?= $this->get_field_name('section') ?>" class="widefat"><?= $selectCategoryHtml ?></select>
        </p>
        <p><label><?= __('Name of the field in which the date of the event is stored: ', 'mcode-calendar') ?></label>
        </p>
        <p><input name="<?= $this->get_field_name('field') ?>" value="<?= $field ?>" class="widefat"/></p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['field'] = (!empty($new_instance['field'])) ? $new_instance['field'] : 'event_datetime';
        $instance['section'] = (!empty($new_instance['section'])) ? $new_instance['section'] : -1;
        return $instance;
    }

}

// регистрация Foo_Widget в WordPress
function mcode_calendar_register()
{
    register_widget('McodeCalendar');
}

add_action('widgets_init', 'mcode_calendar_register');

/***
 * Генерация календаря
 * @param $month
 * @param $year
 * @return string
 */
function mcode_calendar($month, $year, $section, $field)
{
    $events = get_events($section, $field);
    $category = rtrim(get_category_link($section), "/");

    $months = [
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

    $days = [
        __('Mon', 'mcode-calendar'),
        __('Tue', 'mcode-calendar'),
        __('Wed', 'mcode-calendar'),
        __('Thu', 'mcode-calendar'),
        __('Fri', 'mcode-calendar'),
        __('Sat', 'mcode-calendar'),
        __('Sun', 'mcode-calendar'),
    ];

    $day = date('w', mktime(0, 0, 0, $month, 1, $year)) - 1;
    $day = $day == -1 ? 6 : $day;

    $calendar = "<table cellpadding='0' cellspacing='0' class='calendar'>
                    <thead>
                        <tr class='i' data-month='$month' data-year='$year'>
                            <th class='btn prev'><i class='fa fa-angle-left'></i></th>
                            <th colspan='5'>{$months[$month - 1]}, $year</th>
                            <th class='btn next'><i class='fa fa-angle-right'></i></th>
                        </tr>
                        <tr class='dw'><th><div>" . implode("</div></th><th><div>", $days) . "</div></th></tr>
                    </thead>
                    <tbody>
                        <tr class='row'>";

    for ($i = 0; $i < $day; $i++) {
        $calendar .= "<td class='day empty'></td>";
    }

    $count = date('t', mktime(0, 0, 0, $month, 1, $year));
    $current = date('Y-m-d');
    for ($i = 1; $i <= $count; $i++) {
        $dt = date('Y-m-d', mktime(0, 0, 0, $month, $i, $year));
        $currentClass = $current == $dt ? 'current' : '';
        if (!empty($events[$dt])) {
            $calendar .= "<td class='day event $currentClass'>
                                <form action='$category' method='POST'>
                                    <input type='hidden' name='date' value='$dt'/>
                                    <input type='submit' value='$i' title='" . __('Event list', 'mcode-calendar') . "'>
                                </form>
                              </td>";
        } else {
            $calendar .= "<td class='day $currentClass'><div>$i</div></td>";
        }

        if ($day == 6) {
            $calendar .= "</tr>";
            $day = 0;
        } else {
            $day++;
        }
    }

    if ($day != 0) {
        for ($i = 7; $i > $day; $i--) {
            $calendar .= "<td class='day empty'></td>";
        }
    }

    $calendar .= "</tr></tbody></table>";
    return $calendar;
}

/***
 * Получить все меропрития в будущем
 */
function get_future_events($section, $field)
{

    $months = [
        __('f_January', 'mcode-calendar'),
        __('f_February', 'mcode-calendar'),
        __('f_March', 'mcode-calendar'),
        __('f_April', 'mcode-calendar'),
        __('f_May', 'mcode-calendar'),
        __('f_June', 'mcode-calendar'),
        __('f_July', 'mcode-calendar'),
        __('f_August', 'mcode-calendar'),
        __('f_September', 'mcode-calendar'),
        __('f_October', 'mcode-calendar'),
        __('f_November', 'mcode-calendar'),
        __('f_December', 'mcode-calendar'),
    ];

    $query = new WP_Query([
        'posts_per_page' => -1,
        'paged' => 0,
        'post_status' => 'publish',
        'cat' => $section,
        'orderby' => 'meta_value',
        'meta_key' => 'event_datetime',
        'order' => 'ASC'
    ]);

    $result = '';
    if ($query->have_posts()) {
        $result = '<div class="mcode-calendar-future">';
        while ($query->have_posts()) {
            $query->the_post();
            $tm = strtotime(get_post_meta(get_the_ID(), $field, true));
            if ($tm < strtotime('now')) continue;

            $title = get_the_title();
            $description = get_post_meta(get_the_ID(), 'event_description', true);
            $mount = $months[date('n', $tm) - 1];
            $date = date("j $mount Y · H:i", $tm);
            // $date = date('d F Y · H:i', $tm);
            $url = get_permalink(get_the_ID());

            $result .= "<div class='item'><a href='$url' title='$title'>
                <h3>$title</h3><p class='description'>$description</p><p class='datetime'>$date</p></a></div>";
        }
        $result .= '</div>';
    }
    return $result;
}

/***
 * Получить все мероприятия по заданному полю
 * @param $section
 * @param $field
 * @return array
 */
function get_events($section, $field)
{
    $query = new WP_Query([
        'posts_per_page' => -1,
        'paged' => 0,
        'post_status' => 'publish',
        'cat' => $section
    ]);

    $result = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $dt = explode(' ', get_post_meta(get_the_ID(), $field, true));
            if (count($dt) != 2) {
                continue;
            }
            $result[$dt[0]][] = [
                'url' => get_permalink(get_the_ID()),
                'title' => get_the_title(),
                'strtotime' => strtotime(get_post_meta(get_the_ID(), $field, true)),
                'field' => get_post_meta(get_the_ID(), $field, true),
                'day' => $dt[0],
                'time' => $dt[1]
            ];
        }
    }
    return $result;
}

/***
 * AJAX
 */
function mcode_calendar_get_callback()
{
    $month = (int)$_POST['month'];
    $year = (int)$_POST['year'];
    $section = (int)$_POST['section'];
    $field = $_POST['field'];
    if (!is_int($month) || !is_int($year) || !is_int($section) || !preg_match('/\w+/', $field)) {
        echo json_encode(['error' => 'not valid data type']);
    } elseif ($month < 1 || $month > 12 || $year < 2018 || $year > 2100) {
        echo json_encode(['error' => 'not valid value']);
    } else {
        echo json_encode(['html' => mcode_calendar($month, $year, $section, $field)]);
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