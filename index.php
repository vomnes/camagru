<?php
require('controller/controller.php');

session_start();
$page = $_GET['action'];
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
