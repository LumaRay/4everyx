<? 
/**
 * Mailer.php
 *
 * The Mailer class is meant to simplify the task of sending
 * emails to users. Note: this email system will not work
 * if your server is not setup to send mail.
 *
 * If you are running Windows and want a mail server, check
 * out this website to see a list of freeware programs:
 * <http://www.snapfiles.com/freeware/server/fwmailserver.html>
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
 
class Mailer
{
   /**
    * sendWelcome - Sends a welcome message to the newly
    * registered user, also supplying the username and
    * password.
    */
   function sendWelcome($user, $email, $pass){
      $from = "From: ".YX_EMAIL_FROM_NAME." <".YX_EMAIL_FROM_ADDR.">";
      $subject = "Добро пожаловать!";
      $body = $user.",\n\n"
             ."Добро пожаловать! Спасибо за регистрацию на сайте!\n\n"
             ."Ваши регистрационные данные:\n\n"
             ."Логин: ".$user."\n"
             ."Пароль: ".$pass."\n\n"
             ."Еси когда-нибудь вы потеряете или забудете пароль, "
             ."то новый пароль будет сгенерирован и отправлен на указанный "
             ."адрес email, если вы пожелаете сменить "
             ."адрес email, то это можно будет сделать "
             ."в вашем профиле после входа.\n\n"
             ."";

      return mail($email,$subject,$body,$from);
   }
   
   /**
    * sendNewPass - Sends the newly generated password
    * to the user's email address that was specified at
    * sign-up.
    */
   function sendNewPass($user, $email, $pass){
      $from = "From: ".YX_EMAIL_FROM_NAME." <".YX_EMAIL_FROM_ADDR.">";
      $subject = "Сайт - Ваш новый пароль";
      $body = $user.",\n\n"
             ."По вышему запросу был сгенерирован новый пароль. "
             ."Теперь вы можете использовать новый пароль "
             ."при входе на сайт.\n\n"
             ."Логин: ".$user."\n"
             ."Новый пароль: ".$pass."\n\n"
             ."Рекоммендуется сменить пароль на более легкий "
             ."для запоминания, - это можно сделать "
             ."на странице вашего прифиля "
             ."после входа на сайт.\n\n"
             ."";
             
      return mail($email,$subject,$body,$from);
   }
};

/* Initialize mailer object */
$yx_mailer = new Mailer;
 
?>
