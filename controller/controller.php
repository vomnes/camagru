<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/model.php';

function signUp()
{
    $signUpCode = signUpModel();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signUpView.php');
}

function signIn()
{
    $signInData = authLogin();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
}

function activateAccount()
{
    $accountIsActivated = validateaccount();
    if ($accountIsActivated > 0) {
      $signInData = authLogin();
      require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    }
}

function sendResetPasswordEmail()
{
    $code = resetPasswordEmail();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/forgotPasswordView.php');
}

function resetPassword()
{
    $code = handleResetPassword();
    if ($code == -1) {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/resetPasswordView.php');
    }
}

function index()
{
    require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
}
