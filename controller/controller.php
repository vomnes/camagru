<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/model.php';

function signUp()
{
    $signUpCode = signUpModel();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signUpView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}

function signIn()
{
    $signInData = authLogin();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}

function activateAccount()
{
    $accountIsActivated = validateaccount();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    if ($accountIsActivated > 0) {
      $signInData = authLogin();
      require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    }
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}

function sendResetPasswordEmail()
{
    $code = resetPasswordEmail();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/forgotPasswordView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}

function resetPassword()
{
    $code = handleResetPassword();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    if ($code == -1) {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/resetPasswordView.php');
    }
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}

function index()
{
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}
