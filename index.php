<?php
require('controller/controller.php');

session_start();
ob_start();
$page = $_GET['action'];
if (!userLogged()) {
  if (isset($page)) {
      if ($page == 'signup') {
          signUp();
      } else if ($page == 'signin') {
          signIn();
      } else if ($page == 'validateaccount') {
          activateAccount();
      } else if ($page == 'passwordforgotten') {
          sendResetPasswordEmail();
      } else if ($page == 'resetpassword') {
          resetPassword();
      } else {
          index();
      }
  } else {
    index();
  }
} else {
  if (isset($page)) {
      if ($page == 'camera') {

      } elseif ($page == 'gallery') {
          gallery();
      } elseif ($page == 'myprofile') {
          profile();
      } elseif ($page == 'editprofile') {

      } elseif ($page == 'logout') {
          logout();
      } else {
          gallery();
      }
  } else {
    gallery();
  }
}
$content = ob_get_clean();
$data = headerController();
require($_SERVER['DOCUMENT_ROOT'] . '/view/templateView.php');
