<?php
  require("db.php");
  $bdd = new database();

  function userExists($username) {
    $bdd = new database();
    $data = $bdd->getAll('SELECT username FROM Users');
    $dataLen = count($data);
    for($i = 0; $i < $dataLen; $i++) {
      if ($data[$i]["username"] == $username) {
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
        return -2;
      } else if (count($username) > 64 || count($pw) > 255 || count($pw) < 8 || count($emailAddress) > 128) {
        return -4;
      } else if (!userExists($username)) {
        return createUser($username, $pw, $emailAddress); // Error or User created
      } else {
        return -3; // User already exists
      }
    }
    return 0;
  }

  function authLogin() {
    $username = $_REQUEST["username"];
    $pw = $_REQUEST["password"];
    if ($username != '' && $pw != '') {
      if (count($username) > 256 || count($pw) > 256) {
        return -2;
      }
      $bdd = new database();
      $data = $bdd->getAll('SELECT username, password, account_validated FROM Users');
      $dataLen = count($data);
      for($i = 0; $i < $dataLen; $i++) {
        if ($username == $data[$i]["username"] AND hash('whirlpool', $pw) == $data[$i]["password"]) {
          if ($data[$i]["account_validated"] == 0) {
            return -1;
          }
          return 1;
        }
      }
      return -2;
    }
    return 0;
  }
