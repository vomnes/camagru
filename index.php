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
      } elseif ($page == 'gallery') {
          gallery(0);
      } else {
          signIn();
      }
  } else {
    signIn();
  }
} else {
  if (isset($page)) {
      if ($page == 'camera') {
          camera();
      } elseif ($page == 'gallery') {
          gallery(1);
      } elseif ($page == 'picture') {
          picture();
      } elseif ($page == 'myprofile') {
          profile();
      } elseif ($page == 'logout') {
          logout();
      } else {
          gallery(1);
      }
  } else {
    gallery(1);
  }
}
$content = ob_get_clean();
if ($_GET['method'] == '') {
  $data = headerController();
  require($_SERVER['DOCUMENT_ROOT'] . '/view/templateView.php');
} else {
  echo $content;
}
