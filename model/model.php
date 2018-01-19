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

  function createUser($username, $pw, $email, $token) {
    $password = hash('whirlpool', $pw); // Encode password
    if ($password == $pw) {
      return -1;
    }
    $bdd = new database();
    $bdd->insertData(
      'Users',
      'username, password, email, unique_token',
      ':username, :password, :email, :unique_token',
      array('username' => $username, 'password' => $password, 'email' => $email, 'unique_token' => $token));
    return 1;
  }

  function sendEmail($to, $subject, $body) {
    if (mail($to, $subject, $body)) {
      echo "<p>Message successfully sent!</p>";
    } else {
      echo "<p>Message delivery failed...</p>";
    }
  }

  function validationEmail($username, $emailAddress, $token) {
    sendEmail(
      $emailAddress,
      "Camagru - Account validation",
      "Go on localhost:8080/index.php?action=validateaccount&token=".$token);
  }

  function signUpModel() {
    $username = $_REQUEST["username"];
    $pw = $_REQUEST["password"];
    $rePW = $_REQUEST["re-password"];
    $emailAddress = $_REQUEST["email"];
    if ($username != '' && $pw != '' && $rePW != '' && $emailAddress != '') {
      if ($pw != $rePW) {
        return -2;
      } else if (strlen($username) > 64 || strlen($pw) > 255 || strlen($pw) < 8 || strlen($emailAddress) > 128) {
        return -4;
      } else if (!userExists($username)) {
        $uniqueToken = md5(uniqid(rand(), true));
        $ret = createUser($username, $pw, $emailAddress, $uniqueToken); // Error or User created
        if ($ret == -1) {
          return (-1);
        }
        validationEmail($username, $emailAddress, $uniqueToken);
        return $ret;
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

  function validateaccount() {
    $token = $_GET["token"];
    if ($token != '') {
      $bdd = new database();
      $data = $bdd->getAll('SELECT unique_token, account_validated FROM Users');
      $dataLen = count($data);
      for($i = 0; $i < $dataLen; $i++) {
        if ($data[$i]["unique_token"] == $token) {
          if ($data[$i]["account_validated"] == 1) {
            return 2;
          }
          $bdd->updateData("UPDATE Users SET account_validated = 1 WHERE unique_token = \"".$token."\"");
          return 1;
        }
      }
      return false;
    }
    return false;
  }


// abcdABCD1234
