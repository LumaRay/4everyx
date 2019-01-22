<?
/**
 * Process.php
 * 
 * The Process class is meant to simplify the task of processing
 * user submitted forms, redirecting the user to the correct
 * pages if errors are found, or if form is successful, either
 * way. Also handles the logout procedure.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
require_once("session.php");

class Process
{
   /* Class constructor */
   function Process(){
      global $yx_session;
      /* User submitted login form */
      if(isset($_POST['sublogin'])){
         $this->procLogin();
      }
      /* User submitted registration form */
      else if(isset($_POST['subjoin'])){
         $this->procRegister();
      }
      /* User submitted forgot password form */
      else if(isset($_POST['subforgot'])){
         $this->procForgotPass();
      }
      /* User submitted edit account form */
      else if(isset($_POST['subedit'])){
         $this->procEditAccount();
      }
      /**
       * The only other reason user should be directed here
       * is if he wants to logout, which means user is
       * logged in currently.
       */
      else if($yx_session->logged_in){
         $this->procLogout();
      }
      /**
       * Should not get here, which means user is viewing this page
       * by mistake and therefore is redirected.
       */
       else{
          header("Location: /");
       }
   }

   /**
    * procLogin - Processes the user submitted login form, if errors
    * are found, the user is redirected to correct the information,
    * if not, the user is effectively logged in to the system.
    */
   function procLogin(){
      global $yx_session, $yx_form;
      /* Login attempt */
      $retval = $yx_session->login($_POST['user'], $_POST['pass'], isset($_POST['remember']));
      
      /* Login successful */
      if($retval){
         //header("Location: ".$yx_session->referrer);
         header("Location: /");
      }
      /* Login failed */
      else{
         $_SESSION['yx_value_array'] = $_POST;
         $_SESSION['yx_error_array'] = $yx_form->getErrorArray();
         //header("Location: ".$yx_session->referrer);
         header("Location: /");
      }
   }
   
   /**
    * procLogout - Simply attempts to log the user out of the system
    * given that there is no logout form to process.
    */
   function procLogout(){
      global $yx_session;
      $retval = $yx_session->logout();
      //header("Location: main.php");
      header("Location: /");
   }
   
   /**
    * procRegister - Processes the user submitted registration form,
    * if errors are found, the user is redirected to correct the
    * information, if not, the user is effectively registered with
    * the system and an email is (optionally) sent to the newly
    * created user.
    */
   function procRegister(){
      global $yx_session, $yx_form;
      /* Convert username to all lowercase (by option) */
      if(ALL_LOWERCASE){
         $_POST['user'] = strtolower($_POST['user']);
      }
      /* Registration attempt */
      $retval = $yx_session->register($_POST['user'], $_POST['pass'], $_POST['email']);
      
      /* Registration Successful */
      if($retval == 0){
         $_SESSION['yx_reguname'] = $_POST['user'];
         $_SESSION['yx_regsuccess'] = true;
         //header("Location: ".$yx_session->referrer);
         header("Location: /");
      }
      /* Error found with form */
      else if($retval == 1){
         $_SESSION['yx_value_array'] = $_POST;
         $_SESSION['yx_error_array'] = $yx_form->getErrorArray();
         //header("Location: ".$yx_session->referrer);
         header("Location: /");
      }
      /* Registration attempt failed */
      else if($retval == 2){
         $_SESSION['yx_reguname'] = $_POST['user'];
         $_SESSION['yx_regsuccess'] = false;
         //header("Location: ".$yx_session->referrer);
         header("Location: /");
      }
   }
   
   /**
    * procForgotPass - Validates the given username then if
    * everything is fine, a new password is generated and
    * emailed to the address the user gave on sign up.
    */
   function procForgotPass(){
      global $yx_database, $yx_session, $mailer, $yx_form;
      /* Username error checking */
      $subuser = $_POST['user'];
      $field = "user";  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $yx_form->setError($field, "* Username not entered<br>");
      }
      else{
         /* Make sure username is in database */
         $subuser = stripslashes($subuser);
         if(strlen($subuser) < 5 || strlen($subuser) > 30 ||
            !eregi("^([0-9a-z])+$", $subuser) ||
            (!$yx_database->usernameTaken($subuser))){
            $yx_form->setError($field, "* Username does not exist<br>");
         }
      }
      
      /* Errors exist, have user correct them */
      if($yx_form->num_errors > 0){
         $_SESSION['yx_value_array'] = $_POST;
         $_SESSION['yx_error_array'] = $yx_form->getErrorArray();
      }
      /* Generate new password and email it to user */
      else{
         /* Generate new password */
         $newpass = $yx_session->generateRandStr(8);
         
         /* Get email of user */
         $usrinf = $yx_database->getUserInfo($subuser);
         $email  = $usrinf['email'];
         
         /* Attempt to send the email with new password */
         if($mailer->sendNewPass($subuser,$email,$newpass)){
            /* Email sent, update database */
            $yx_database->updateUserField($subuser, "password", md5($newpass));
            $_SESSION['yx_forgotpass'] = true;
         }
         /* Email failure, do not change password */
         else{
            $_SESSION['yx_forgotpass'] = false;
         }
      }
      
      header("Location: ".$yx_session->referrer);
   }
   
   /**
    * procEditAccount - Attempts to edit the user's account
    * information, including the password, which must be verified
    * before a change is made.
    */
   function procEditAccount(){
      global $yx_session, $yx_form;
      /* Account edit attempt */
      $retval = $yx_session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email']);

      /* Account edit successful */
      if($retval){
         $_SESSION['yx_useredit'] = true;
         header("Location: ".$yx_session->referrer);
      }
      /* Error found with form */
      else{
         $_SESSION['yx_value_array'] = $_POST;
         $_SESSION['yx_error_array'] = $yx_form->getErrorArray();
         header("Location: ".$yx_session->referrer);
      }
   }
};

/* Initialize process */
$yx_process = new Process;

?>
