<?
/**
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
//require_once("include/session.php");
?>

<?
/**
 * The user is already logged in, not allowed to register.
 */
if($yx_session->logged_in){
   echo "<h1>Уже зарегистрирован</h1>";
   echo "<p><b>$yx_session->username</b>, вы уже зарегистрированы. "
       ."<a href=\"main.php\">Main</a>.</p>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
      echo "<h1>Регистрация завершена!</h1>";
      echo "<p>Спасибо, <b>".$_SESSION['reguname']."</b>, ваш профиль добавлен, "
          ."теперь вы можете <a href=\"main.php\">войти</a>.</p>";
   }
   /* Registration failed */
   else{
      echo "<h1>Ошибка при регистрации</h1>";
      echo "<p>К сожалению, во время регистрации пользователя <b>".$_SESSION['reguname']."</b> произошла ошибка."
          ."<br>Пожалуйста, повторите попытку позже.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>

<h1>Регистрация</h1>
<?
if($yx_form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$yx_form->num_errors." ошибок найдено</font></td>";
}
?>
<form action="include/process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Логин:</td><td><input type="text" name="user" maxlength="30" value="<? echo $yx_form->value("user"); ?>"></td><td><? echo $yx_form->error("user"); ?></td></tr>
<tr><td>Пароль:</td><td><input type="password" name="pass" maxlength="30" value="<? echo $yx_form->value("pass"); ?>"></td><td><? echo $yx_form->error("pass"); ?></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<? echo $yx_form->value("email"); ?>"></td><td><? echo $yx_form->error("email"); ?></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1">
<input type="submit" value="Join!"></td></tr>
<tr><td colspan="2" align="left"><a href="/">Вернуться на главную</a></td></tr>
</table>
</form>

<?
}
?>
