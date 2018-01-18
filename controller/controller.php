<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/model.php';

function signUp()
{
    $signUpCode = signUpModel();
    print($signUpCode);
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signUpView.php');
}
