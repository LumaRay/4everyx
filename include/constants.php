<?
require_once("config.inc.php");
/**
 * Constants.php
 *
 * This file is intended to group all constants to
 * make it easier for the site administrator to tweak
 * the login script.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
 
/**
 * Database Table Constants - these constants
 * hold the names of all the database tables used
 * in the script.
 */
define("YX_TBL_USERS", YX_DB_PREFIX."users");
define("YX_TBL_ACTIVE_USERS",  YX_DB_PREFIX."active_users");
define("YX_TBL_ACTIVE_GUESTS", YX_DB_PREFIX."active_guests");
define("YX_TBL_BANNED_USERS",  YX_DB_PREFIX."banned_users");

/**
 * Special Names and Level Constants - the admin
 * page will only be accessible to the user with
 * the admin name and also to those users at the
 * admin user level. Feel free to change the names
 * and level constants as you see fit, you may
 * also add additional level specifications.
 * Levels must be digits between 0-9.
 */
define("YX_ADMIN_NAME", "admin");
define("YX_GUEST_NAME", "guest");
define("YX_ADMIN_LEVEL", 9);
define("YX_USER_LEVEL",  1);
define("YX_GUEST_LEVEL", 0);

/**
 * This boolean constant controls whether or
 * not the script keeps track of active users
 * and active guests who are visiting the site.
 */
define("YX_TRACK_VISITORS", true);

/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("YX_TIMEOUT_USER", 10);
define("YX_TIMEOUT_GUEST", 5);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("YX_COOKIE_EXPIRE", 60*60*24*100);  //100 days by default
define("YX_COOKIE_PATH", "/");  //Avaible in whole domain

/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("YX_EMAIL_FROM_NAME", "admin");
define("YX_EMAIL_FROM_ADDR", "admin@4everyx.ru");
define("YX_EMAIL_WELCOME", false);

/**
 * This constant forces all users to have
 * lowercase usernames, capital letters are
 * converted automatically.
 */
define("YX_ALL_LOWERCASE", false);
?>
