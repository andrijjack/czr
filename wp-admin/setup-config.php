<?php
/**
 * Retrieves and creates the wp-config.php file.
 *
 * The permissions for the base directory must allow for writing files in order
 * for the wp-config.php to be created using this page.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * We are installing.
 *
 * @package WordPress
 */
define('WP_INSTALLING', true);

/**#@+
 * These three defines are required to allow us to use require_wp_db() to load
 * the database class while being wp-content/db.php aware.
 * @ignore
 */
define('ABSPATH', dirname(dirname(__FILE__)).'/');
define('WPINC', 'wp-includes');
define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
/**#@-*/

require_once('../wp-includes/compat.php');
require_once('../wp-includes/functions.php');
require_once('../wp-includes/classes.php');

if (!file_exists('../wp-config-sample.php'))
	wp_die('Вибачте, для роботи мені потрібен файл wp-config-sample.php. Будь ласка перезалийте його повторно з вашої інсталяції WordPress.');

$configFile = file('../wp-config-sample.php');

if ( !is_writable('../'))
	wp_die("Вибачте, я не можу писати до директорії. Ви повинні змінити права доступу до директорії WordPress чи створити wp-config.php вручну.");

// Check if wp-config.php has been created
if (file_exists('../wp-config.php'))
	wp_die("<p>Файл 'wp-config.php' уже існує. Якщо бажаєте скинути конфігурацію, видаліть спочатку файл 'wp-config.php'. Ви можете спробувати <a href='install.php'>встановити зараз</a>.</p>");

// Check if wp-config.php exists above the root directory
if (file_exists('../../wp-config.php') && ! file_exists('../../wp-load.php'))
	wp_die("<p>Файл 'wp-config.php' вже існує рівнем вище директорії WordPress. Якщо бажаєте скинути конфігурацію, видаліть спочатку файл 'wp-config.php'. Ви можете спробувати <a href='install.php'>встановити зараз</a>.</p>");

if (isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = 0;

/**
 * Display setup wp-config.php file header.
 *
 * @ignore
 * @since 2.3.0
 * @package WordPress
 * @subpackage Installer_WP_Config
 */
function display_header() {
	header( 'Content-Type: text/html; charset=utf-8' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WordPress &rsaquo; Створення конфігураційного файлу</title>
<link rel="stylesheet" href="css/install.css" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="WordPress" src="images/wordpress-logo.png" /></h1>
<?php
}//end function display_header();

switch($step) {
	case 0:
		display_header();
?>

<p>Ласкаво просимо до WordPress. Перш ніж почати, нем необхідна деяка інформація про вашу Базу Даних(БД). Вас слід уточнити їх, перш ніж почати.</p>
<ol>
	<li>Назва БД</li>
	<li>Користувач БД</li>
	<li>Пароль БД</li>
	<li>Сервер БД</li>
	<li>Префікс таблиць (за бажанням ви можете встановити кілька копій WordPress на одну й ту ж БД) </li>
</ol>
<p><strong>Якщо з певних причин створення файлу не відбулося — не хвилюйтесь. Все це ви можете заповнити в файлі конфігурації. Всього-навсього відкрийте <code>wp-config-sample.php</code> у текстовому редакторі, введіть ваші дані та збережіть як <code>wp-config.php</code>. </strong></p>
<p>Скоріш за все необхідна інформація була надана компанією, яка надає послуги хостинґу. Якщо ж ні — уточніть її перш ніж продовжити. Якщо ж все готово&hellip;</p>

<p class="step"><a href="setup-config.php?step=1" class="button">Вперед!</a></p>
<?php
	break;

	case 1:
		display_header();
	?>
<form method="post" action="setup-config.php?step=2">
	<p>Введіть нижче деталі підключення. Якщо ви не впевнені — зверніться до компанії, яка надає послуги хостинґу. </p>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="dbname">Назва БД</label></th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="wordpress" /></td>
			<td>Назва БД на якій ви хочете встановити WP. </td>
		</tr>
		<tr>
			<th scope="row"><label for="uname">Користувач БД</label></th>
			<td><input name="uname" id="uname" type="text" size="25" value="username" /></td>
			<td>Ваш MySQL лоґін</td>
		</tr>
		<tr>
			<th scope="row"><label for="pwd">Пароль</label></th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="password" /></td>
			<td>...та MySQL пароль.</td>
		</tr>
		<tr>
			<th scope="row"><label for="dbhost">Сервер БД</label></th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>99% відсотків, що вам непотрібно це змінювати.</td>
		</tr>
		<tr>
			<th scope="row"><label for="prefix">Префікс таблиць</label></th>
			<td><input name="prefix" id="prefix" type="text" id="prefix" value="wp_" size="25" /></td>
			<td>Якщо бажаєте встановлювати кілька копій WordPress на одну й ту ж БД — змініть їх.</td>
		</tr>
	</table>
	<p class="step"><input name="submit" type="submit" value="Надіслати" class="button" /></p>
</form>
<?php
	break;

	case 2:
	$dbname  = trim($_POST['dbname']);
	$uname   = trim($_POST['uname']);
	$passwrd = trim($_POST['pwd']);
	$dbhost  = trim($_POST['dbhost']);
	$prefix  = trim($_POST['prefix']);
	if (empty($prefix)) $prefix = 'wp_';

	// Test the db connection.
	/**#@+
	 * @ignore
	 */
	define('DB_NAME', $dbname);
	define('DB_USER', $uname);
	define('DB_PASSWORD', $passwrd);
	define('DB_HOST', $dbhost);
	/**#@-*/

	// We'll fail here if the values are no good.
	require_wp_db();
	if ( !empty($wpdb->error) )
		wp_die($wpdb->error->get_error_message());

	$handle = fopen('../wp-config.php', 'w');

	foreach ($configFile as $line_num => $line) {
		switch (substr($line,0,16)) {
			case "define('DB_NAME'":
				fwrite($handle, str_replace("putyourdbnamehere", $dbname, $line));
				break;
			case "define('DB_USER'":
				fwrite($handle, str_replace("'usernamehere'", "'$uname'", $line));
				break;
			case "define('DB_PASSW":
				fwrite($handle, str_replace("'yourpasswordhere'", "'$passwrd'", $line));
				break;
			case "define('DB_HOST'":
				fwrite($handle, str_replace("localhost", $dbhost, $line));
				break;
			case '$table_prefix  =':
				fwrite($handle, str_replace('wp_', $prefix, $line));
				break;
			default:
				fwrite($handle, $line);
		}
	}
	fclose($handle);
	chmod('../wp-config.php', 0666);

	display_header();
?>
<p>Все чудово! Ви успішно справились з цією частиною встановлення. WordPress може підключитись до БД. Якщо ви готові, то вперед&hellip;</p>

<p class="step"><a href="install.php" class="button">Почати встановлення</a></p>
<?php
	break;
}
?>
</body>
</html>
