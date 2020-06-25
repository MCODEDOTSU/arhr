<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'arhr' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'arhr' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'N%?GDV@PBm' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'p_db_mysql' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'aA|m9coh+l(ctICP{JS@sE_QdskM;hV.eV|L62-*u!n)2cK8(r*Ow-@t;e ~rS6j');
define('SECURE_AUTH_KEY',  'gh<*m*%rG[~*/wDY_u;&^wJ~4IR3-q@LAwvsKy/t|dG+3s7Ww.kbIww5/.u*qeOB');
define('LOGGED_IN_KEY',    '~P-LR_9:=w0,]=8X.cdoX|~A&<(%csxE!SpPrb:W5khRY`]?uIV;T#Orw+C1})0g');
define('NONCE_KEY',        'J^=)L6(x:/q{+$Zop|oQoU$OKiOMjl~4Ji9g;-Qp0?Ix}@-M~==YeU:q[g(@LWs?');
define('AUTH_SALT',        'Wy+GJvN&}kG=tI,<WUb;BNta3E{w{Cuke[yn$HJ9gO]GP81+B$$#h+;M}/x`Q5ue');
define('SECURE_AUTH_SALT', '/7V6i-RHWr 7vL+UK%Gk< *qlkVP[5{2;@r+J09/5+=nLC+P|h[U~rjAS`_y_Wxz');
define('LOGGED_IN_SALT',   'c]}&R@)j.ME}P2L/x?%>fI2OwxTA,D>L.XD2D;+8HE]|<YTK_OE~cuRds|y:.wPw');
define('NONCE_SALT',       'rO-m5I+*`<U6U{n|JQ~+(1;$BBHJvC[6E5Pe4O+b+0Of*Oh!R$+)IW>`^cJ m}cE');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
