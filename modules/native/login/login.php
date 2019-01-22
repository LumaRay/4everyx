<?
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($yx_session->logged_in){
   echo "<h1>Здравствуйте</h1>";
   echo "Здравствуйте, <b>$yx_session->username</b>. <br><br>"
       ."[<a href=\"userinfo.php?user=$yx_session->username\">Профиль</a>] &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Редактировать профиль</a>] &nbsp;&nbsp;";
   if($yx_session->isAdmin()){
      echo "[<a href=\"admin/admin.php\">Администрирование</a>] &nbsp;&nbsp;";
   }
   echo "[<a href=\"process.php\">Logout</a>]";
}
else{
?>

<?=$yx_elements->CreateHeader("Вход");?>
<?
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($yx_form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$yx_form->num_errors." ошибок найдено</font>";
}
?>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Логин:</td><td><input type="text" name="user" maxlength="30" value="<? echo $yx_form->value("user"); ?>"></td><td><? echo $yx_form->error("user"); ?></td></tr>
<tr><td>Пароль:</td><td><input type="password" name="pass" maxlength="30" value="<? echo $yx_form->value("pass"); ?>"></td><td><? echo $yx_form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember" <? if($yx_form->value("remember") != ""){ echo "checked"; } ?>>
<font size="2">Запомнить меня &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>
<tr><td colspan="2" align="left"><br><font size="2">[<a href="forgotpass.php">Забыли пароль?</a>]</font></td><td align="right"></td></tr>
<tr><td colspan="2" align="left"><br>Не зарегистрированы? <a id="register" href="javascript:;">Зарегистрируйтесь!</a></td></tr>
</table>
<script type="text/javascript">
jQuery("a#register").click(function () {
    jQuery("#main_frame")
    .html("<center>...подождите...</center>")
    .load("modules.php?module=native.register", function () {ruzee_border.render('main_frame');});
});
</script>
</form>

<?
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */
//echo "</td></tr><tr><td align=\"center\"><br><br>";
echo "<b>Всего пользователей:</b> ".$yx_database->getNumMembers()."<br>";
echo "Сайт просматривают: зарегистрированных пользователей - $yx_database->num_active_users, ";
echo "гостей - $yx_database->num_active_guests.<br><br>";

//include("include/view_active.php");

?>
