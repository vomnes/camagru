<?php
  require("db.php");
  $bdd = new database();

  /* Session */

  function userLogged() {
    session_start();
    if (isset($_SESSION["logged_user"]) && $_SESSION["logged_user"] != '') {
      return true;
    }
    return false;
  }

  function logoutUser() {
    session_start();
    if (isset($_SESSION["logged_user"])) {
      $_SESSION["logged_user"] = "";
      $_SESSION["logged_userId"] = "";
    }
  }

  /* ------ */

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
      $data = $bdd->getAll('SELECT id, username, password, account_validated, email FROM Users');
      $dataLen = count($data);
      for($i = 0; $i < $dataLen; $i++) {
        if ($username == $data[$i]["username"] AND hash('whirlpool', $pw) == $data[$i]["password"]) {
          if ($data[$i]["account_validated"] == 0) {
            return array("code" => -1, "accountEmail" => $data[$i]["email"]); // Account not yet validated
          }
          session_start();
          $_SESSION["logged_user"] = $username;
          $_SESSION["logged_userId"] = $data[$i]["id"];
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

  function downloadImage($path_to_image)
  {
    $filename = basename($path_to_image);
  	header("Content-Transfer-Encoding: binary");
  	header("Content-Type: image/jpg");
  	header("Content-Disposition: attachment; filename=$filename");
  	readfile($path_to_image);
  }
  if (isset($_POST['button'])){
    $filepath = $_POST['ImagePath'];
    if ($filepath!="") {
      downloadImage($filepath);
    } else {
      echo "No image path.";
    }
  }

  function savePicture() {
    $photo = $_POST['photo'];
    if (isset($photo)) {
      $filters = $_POST['filters'];
      $filename = $_SESSION["logged_user"] . '-' . 'picture-' . substr(md5(mt_rand()), 0, 12) . '.png';
      createPicture($photo, json_decode($filters, true), $filename);
      pictureInDB("public/pictures/users-pictures/" . $filename);
    } else {
      echo 'Error: No photo';
    }
  }

  function pictureInDB($file_path) {
    session_start();
    $td = new database();
    $td->insertData(
      'pictures',
      'userId, file_path',
      ':userId, :file_path',
      array(
        'userId' => $_SESSION["logged_userId"],
        'file_path' => $file_path,
      ));
  }

  function lastPicture() {
    session_start();
    $td = new database();
    $lastPicture = $td->getOne('SELECT file_path FROM Pictures WHERE userId = ' . $_SESSION["logged_userId"] . ' ORDER BY creation_date DESC LIMIT 1');
    return $lastPicture["file_path"];
  }

  function createPicture($photo, $filters, $filename) {
    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo));
    if (isset($filters)) {
      $img = mergePictures($data, $filters);
      imagepng($img, "public/pictures/users-pictures/" . $filename);
    } else {
      file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/public/pictures/users-pictures/" . $filename, $data);
    }
  }

  function mergePictures($photo, $filtersArray) {
    $width = 500;
    $height = 375;

    $final_img = imagecreatetruecolor($width, $height);
    // imagealphablending($final_img, true);
    imagesavealpha($final_img, true);

    // Add webcam picture
    $frame = imagecreatefromstring($photo);
    imagecopy($final_img, $frame, 0, 0, 0, 0, $width, $height);
    // Add filters
    foreach ($filtersArray as $key => $filter) {
      $frame = imagecreatefrompng(strstr($filter, 'public'));
      imagecopy($final_img, $frame, 0, 0, 0, 0, $width, $height);
    }
    return $final_img;
  }

  function getUserPictures() {
    session_start();
    $td = new database();
    $userPictures = $td->getAll('SELECT id, file_path FROM Pictures WHERE userId = ' . $_SESSION["logged_userId"] . ' ORDER BY creation_date DESC');
    return $userPictures;
  }

  function getAllPictures() {
    $td = new database();
    $allPictures = $td->getAll('SELECT id, userId, file_path FROM Pictures ORDER BY creation_date DESC');
    return $allPictures;
  }

  function commentInDB() {
    session_start();
    $userId = $_SESSION["logged_userId"];
    $content = $_POST["content"];
    $pictureId = $_GET["id"];
    $td = new database();
    $td->insertData(
      'Comments',
      'pictureId, userId, content',
      ':pictureId, :userId, :content',
      array(
        'pictureId' => intval($pictureId, 10),
        'userId' => intval($userId, 10),
        'content' => $content,
      ));
  }

  function getPictureComments() {
    $pictureId = $_GET["id"];
    $td = new database();
    $pictureComments = $td->getAll('SELECT c.content,  u.username FROM Comments c LEFT JOIN Users u ON u.id=c.userId WHERE pictureId = ' . $pictureId . ' ORDER BY c.creation_date ASC;');
    return $pictureComments;
  }

  // 'SELECT p.id, p.file_path as file_path, u.username, u.profile_picture from Pictures p left join Users u on u.id=p.userId';

// abcdABCD1234
