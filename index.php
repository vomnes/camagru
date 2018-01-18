<?php
require('controller/controller.php');

session_start();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'signup') {
        signUp();
    }
} else {
  signUp();
}
