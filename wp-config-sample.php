<?php
/** 
 * Конфігурація бази даних WordPress.
 *
 * В цьому файлі доступні такі налаштування: MySQL налаштування, Префікс Таблиці,
 * Секретні Ключі, Мова WordPress, and ABSPATH. ви можете дізнатись більше відвідавши
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Ви можете дізнатись налаштування MySQL, запитавши у хостера.
 *
 * Цей файл використовується для сворення файлу wp-config.php
 * за допомогою спеціального скрипта під час інсталяції.
 * Для введеня необхідних даних вам не обов’язково користуватися веб-сайтом, ви можете просто
 * скопіювати цей файл до "wp-config.php" та ввести необхідні значення.
 *
 * @package WordPress
 */

// ** Налаштування MySQL - Їх ви можете дізнатись у вашого хостера ** //
/** Назва БД для Wordpress */
define('DB_NAME', 'putyourdbnamehere');

/** Назва користувача БД MySQL */
define('DB_USER', 'usernamehere');

/** Пароль БД MySQL */
define('DB_PASSWORD', 'yourpasswordhere');

/** MySQL хост */
define('DB_HOST', 'localhost');

/** Кодування БД для створення відповідної при встановленні. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Не змінюйте, якщо сумніваєтесь. */
define('DB_COLLATE', '');

/**#@+
 * Аутентифікація Унікальними Ключами.
 *
 * Змініть це на різноманітні унікальні фрази!
 * Ви можете згенерувати їх використовуючи {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'put your unique phrase here');
define('SECURE_AUTH_KEY', 'put your unique phrase here');
define('LOGGED_IN_KEY', 'put your unique phrase here');
define('NONCE_KEY', 'put your unique phrase here');
/**#@-*/

/**
 * Префікс БД WordPress.
 *
 * Ви можете мати декілька інсталяцій на одній БД, якщо ввведети різні префікси.
 * Вживайте тільки числа, літери та знак підкреслення!
 */
$table_prefix  = 'wp_';

/**
 * Локалізації Wordpress, стандартно українська.
 *
 * Змініть це для локалізації WordPress.  Відповідний MO файл для обраної мови
 * повинен бути встановлений в директорії wp-content/languages. для прикладу
 * встановіть uk.mo до wp-content/languages та змініть WPLANG до 'uk' для активації
 * підтримки української мови.
 */
define ('WPLANG', 'uk');

/**
* #@+
* Час життя вмісту кошика(публікації, сторінки, вкладення)
* Стандартно 30 днів, але Ви можете задати іншу кількість днів
* @since 2.9.0
*/

define( 'EMPTY_TRASH_DAYS', 30 );

/* Це все, досить редагувати. Щасливого блоґґінґу! */

/** WordPress абсолютний шлях до каталогу Wordpress */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Встановити WordPress змінні та вкладені файли. */
require_once(ABSPATH . 'wp-settings.php');
?>
