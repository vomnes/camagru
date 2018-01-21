<?php
require('controller/controller.php');

session_start();
ob_start();
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
$content = ob_get_clean();
require($_SERVER['DOCUMENT_ROOT'] . '/view/templateView.php');
