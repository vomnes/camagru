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

  function createUser($username, $pw) {
    $bdd = new database();
    $bdd->insertData('Users', 'Username, Password', ':username, :password', array('username' => $username, 'password' => $pw));
  }

  function signUpModel() {
    $username = $_REQUEST["username"];
    $pw = $_REQUEST["password"];
    $emailAddress = $_REQUEST["email"];
    if ($username != '' && $pw != '' && $emailAddress != '') {
      if (!userExists($username, $emailAddress)) {
        createUser($username, $pw);
        return 1; // User created
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
