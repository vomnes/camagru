<?php
require('controller/controller.php');

session_start();
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'signup') {
        signUp();
    } else if ($_GET['action'] == 'signin') {
        signIn();
    } else if ($_GET['action'] == 'validateaccount') {
        activateAccount();
    } else {
        index();
    }
} else {
  index();
}
