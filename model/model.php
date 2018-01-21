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
      "Welcome ".$username.", Go on localhost:8080/index.php?action=validateaccount&token=".$token." to validate your account.");
  }

  function signUpModel() {
    $username = $_REQUEST["username"];
    $pw = $_REQUEST["password"];
    $rePW = $_REQUEST["re-password"];
    $emailAddress = $_REQUEST["email"];
    if ($username != '' && $pw != '' && $rePW != '' && $emailAddress != '') {
      if ($pw != $rePW) {
        return -2; // The two passwords must be identical
      } else if (strlen($username) > 64 || strlen($pw) > 255 || strlen($pw) < 8 || strlen($emailAddress) > 128) {
        return -4; // Fields with limits, please respect the warnings
      } else if (!userExists($username)) {
        $uniqueToken = md5(uniqid(rand(), true));
        $ret = createUser($username, $pw, $emailAddress, $uniqueToken); // Error or User created
        if ($ret == -1) {
          return -1; // An error has occured
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
        return array("code" => -2);
      }
      $bdd = new database();
      $data = $bdd->getAll('SELECT username, password, account_validated, email FROM Users');
      $dataLen = count($data);
      for($i = 0; $i < $dataLen; $i++) {
        if ($username == $data[$i]["username"] AND hash('whirlpool', $pw) == $data[$i]["password"]) {
          if ($data[$i]["account_validated"] == 0) {
            return array("code" => -1, "accountEmail" => $data[$i]["email"]); // Account not yet validated
          }
          return array("code" => 1);
        }
      }
      return array("code" => -2); // Wrong username or password
    } else if ($username == '' && $pw != '') {
      return array("code" => -3); // Username can not be empty
    } else if ($pw == '' && $username != '') {
      return array("code" => -4); // Password can not be empty
    }
    return array("code" => 0);
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

  function sendResetEmail($username, $emailAddress, $token) {
    sendEmail(
      $emailAddress,
      "Camagru - Set new password",
      "Hello ".$username.", This is the link to generate a new password: localhost:8080/index.php?action=resetpassword&token=".$token."");
  }

  function resetPasswordEmail() {
    $username = $_REQUEST["username"];
    if ($username != '') {
      $bdd = new database();
      $data = $bdd->getAll('SELECT username, unique_token, account_validated, email FROM Users');
      $dataLen = count($data);
      for($i = 0; $i < $dataLen; $i++) {
        if ($username == $data[$i]["username"]) {
          if ($data[$i]["account_validated"] == 0) {
            return -1; // Account not yet validated
          }
          sendResetEmail($username, $data[$i]["email"], $data[$i]["unique_token"]);
          return 1; // Email with set new password link sent
        }
      }
      return -2; // User does not exists
    }
  }

  function checkTokenValidity($token) {
    if ($token == '') {
      return false;
    }
    $bdd = new database();
    $data = $bdd->getAll('SELECT unique_token FROM Users');
    $dataLen = count($data);
    for($i = 0; $i < $dataLen; $i++) {
      if ($token == $data[$i]["unique_token"]) {
        return true;
      }
    }
    return false;
  }

  function handleResetPassword() {
    $token = $_GET["token"];
    if (!checkTokenValidity($token)) {
      return -1; // Invalid token -> Redirect to index
    }
    $pw = $_REQUEST["password"];
    $rePW = $_REQUEST["re-password"];
    if ($pw != '' && $rePW != '') {
      if ($pw != $rePW) {
        return -2; // The two passwords must be identical
      } else if (strlen($pw) > 255 || strlen($pw) < 8) {
        return -3; // Fields with limits, please respect the warnings
      }
      $bdd = new database();
      $bdd->updateData("UPDATE Users SET password = \"".hash('whirlpool', $pw)."\" WHERE unique_token = \"".$token."\"");
      return 1; // Password updated
    }
  }


// abcdABCD1234
