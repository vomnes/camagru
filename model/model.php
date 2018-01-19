<?php
  require("db.php");
  $bdd = new database();

  function userExists($username) {
    $bdd = new database();
    $data = $bdd->getAll('SELECT Username FROM Users');
    $dataLen = count($data);
    for($i = 0; $i < $dataLen; $i++) {
      if ($data[$i]["Username"] == $username) {
        return true;
      }
    }
    return false;
  }

  function createUser($username, $pw, $email) {
    $password = hash('whirlpool', $pw); // Encode password
    if ($password == $pw) {
      return -1;
    }
    $bdd = new database();
    $bdd->insertData(
      'Users',
      'username, password, email',
      ':username, :password, :email',
      array('username' => $username, 'password' => $password, 'email' => $email));
    return 1;
  }

  function signUpModel() {
    $username = $_REQUEST["username"];
    $pw = $_REQUEST["password"];
    $rePW = $_REQUEST["re-password"];
    $emailAddress = $_REQUEST["email"];
    if ($username != '' && $pw != '' && $rePW != '' && $emailAddress != '') {
      if ($pw != $rePW) {
        return 6;
      } else if (!userExists($username)) {
        return createUser($username, $pw, $emailAddress); // Error or User created
      } else {
        return 2; // User already exists
      }
    } else if ($username != '') {
        return 3; // Username empty
    } else if ($pw != '') {
        return 4; // Password empty
    } else if ($emailAddress != '') {
        return 5; // Email address empty
    }
    return 0;
  }
