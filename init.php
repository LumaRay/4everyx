<?php
define( 'YX_SITE_ROOT', getcwd() . '/' );

if ( file_exists( YX_SITE_ROOT . 'include/config.inc.php') ) {
  require_once( YX_SITE_ROOT . 'include/config.inc.php' );
} else { die("Err"); }

if ( file_exists( YX_SITE_ROOT . 'include/settings.php') ) {
  require_once( YX_SITE_ROOT . 'include/settings.php' );
} else { die("Err"); }
//include SITE_ROOT . 'inc/settings.php';

if ( file_exists( YX_SITE_ROOT . 'include/functions.php') ) {
  require_once( YX_SITE_ROOT . 'include/functions.php' );
} else { die("Err"); }

if ( file_exists( YX_SITE_ROOT . 'include/database.php') ) {
  require_once( YX_SITE_ROOT . 'include/database.php' );
} else { die("Err"); }

if ( file_exists( YX_SITE_ROOT . 'include/elements.php') ) {
  require_once( YX_SITE_ROOT . 'include/elements.php' );
} else { die("Err"); }

if ( file_exists( YX_SITE_ROOT . 'include/module.php') ) {
  require_once( YX_SITE_ROOT . 'include/module.php' );
} else { die("Err"); }

include("include/session.php");

//$dblink = mysql_connect(YX_DB_HOST, YX_DB_USER, YX_DB_PASS) or die("Could not connect: " . mysql_error());
//mysql_selectdb(YX_DB_NAME, $dblink) or die ("Can\'t use dbmapserver : " . mysql_error());

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: text/html; charset=utf-8");

setlocale(LC_ALL, 'UTF8');

if (function_exists('mysql_set_charset'))
    mysql_set_charset('utf8');
else
    mysql_query("SET NAMES 'utf8'", $GLOBALS['yx_database']);

foreach ($_POST as $key => $val) {
    $_POST[$key] = yx_clean_str($_POST[$key]);
}

foreach ($_GET as $key => $val) {
    $_GET[$key] = yx_clean_str($_GET[$key]);
}

?>