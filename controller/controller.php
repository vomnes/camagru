<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/model.php';

function signUp()
{
    $signUpCode = signUpModel();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/headerView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signUpView.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/view/footerView.php');
}
