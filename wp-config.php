<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'blogzine' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '>t$JfqR1Cr%Aq!`?d1aV`e]Hz(I)op}x~Ze3<ZDFNoQO{+Y#[/gWX~Ajy^}u{;mI' );
define( 'SECURE_AUTH_KEY',  'Ycjhm<sNtH(uwiQt3JOsOyFE][Z~.UM;e|N2as,)cH]`hRr/X2v~#I]1fun]anH5' );
define( 'LOGGED_IN_KEY',    'jIvhr S@=B-L`hk-17x{{Y6U3,A?P?0o/-$OA~GET6o T1ZI j:%v?{(xOUXA757' );
define( 'NONCE_KEY',        ':<FPcT|*BFI%*P~4g}Kw@Ud9$TA6FX*hzL B23!E(&~ZsFHvC B~liRz.`b,EDf3' );
define( 'AUTH_SALT',        'bIOmm.7$D.V715qPliUR6sPnm_u-Mox|1U|uCFel*91DQ`.+bT*C8>0B|_dyO1i5' );
define( 'SECURE_AUTH_SALT', 'yGsrpb-r.6gEuBbBWm<vLG53YRMCJ$Cm](e(9Fw1fR9M)+[N)N*&|$1hXo@ /VTl' );
define( 'LOGGED_IN_SALT',   'NX!%(jYu6_I 5}k#zC,u3^o1L=PzHH~WM6_&8+rG;e!_RAl/AWb1=5)s*3c_^R)R' );
define( 'NONCE_SALT',       '!Jvl&}`G<&~!498K3e4y{43-iv4lznR16?w_,Fx,Y>!GdP=L]OI,vs{(_6euK3XT' );

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
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
