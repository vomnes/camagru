<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/model.php';

function signUp()
{
    $signUpCode = signUpModel();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signUpView.php');
}

function signIn()
{
    $signInData = authLogin();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
}

function activateAccount()
{
    $accountIsActivated = validateaccount();
    if ($accountIsActivated > 0) {
      $signInData = authLogin();
      require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    }
}

function sendResetPasswordEmail()
{
    $code = resetPasswordEmail();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/forgotPasswordView.php');
}

function resetPassword()
{
    $code = handleResetPassword();
    if ($code == -1) {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
    } else {
      require($_SERVER['DOCUMENT_ROOT'] . '/view/resetPasswordView.php');
    }
}

function index()
{
    require($_SERVER['DOCUMENT_ROOT'] . '/view/indexView.php');
}

function camera()
{
    if ($_GET["method"] == "savepicture") {
      savePicture();
    } elseif ($_GET["method"] == "lastpicture") {
      echo lastPicture();
    } else {
      $userPictures = getUserPictures();
      require($_SERVER['DOCUMENT_ROOT'] . '/view/cameraView.php');
    }
}

function gallery($userStatus)
{
    $method = $_GET["method"];
    if (isset($method)) {
      if (isset($_GET["id"])) {
        if (!isValidInt($_GET["id"]) || !isValidPictureId($_GET["id"])) {
          return responseHTTP(406, 'Error: Not a valid Id');
        }
        if ($method == "postcomment") {
          commentInDB();
          sendCommentNotif();
          return;
        } else if ($method == "getcomments") {
          $commentsList = getPictureComments();
          echo json_encode($commentsList);
          return;
        } else if ($method == "updatelikes") {
          if (isset($_GET["type"])) {
            updateLikes();
            return;
          }
          echo 'Error: Type in url expected';
          return;
        } else if ($method == "deletepicture") {
          deletePicture();
          return;
        }
      }
      if ($method == "nextpictures") {
        $offset = intval($_GET["offset"]);
        $allPictures = getAllPictures($offset);
        require($_SERVER['DOCUMENT_ROOT'] . '/view/galleryView.php');
        return;
      }
    }
    echo '<script src="public/js/gallery.js"></script>';
    echo '<h2 id="title-page">Gallery</h2>';
    $offset = 0;
    if ($userStatus == 1) {
      $hasLiked = getUserLikes();
    }
    $allPictures = getAllPictures($offset);
    require($_SERVER['DOCUMENT_ROOT'] . '/view/galleryView.php');
}

function picture() {
    $pictureData = getPicture();
    if ($pictureData == null) {
      header('Location: index.php?action=gallery');
      return;
    }
    $hasLiked = getUserLikes();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/pictureView.php');
}

function profile()
{
    $method = $_GET["method"];
    if (isset($method)) {
      if ($method == "savechange") {
        updateProfileData();
        return;
      }
    }
    $profileData = getProfileData();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/myProfileView.php');
}

function logout()
{
    logoutUser();
    require($_SERVER['DOCUMENT_ROOT'] . '/view/signInView.php');
}

function headerController() {
  session_start();
  return array(
    'isLogged' => userLogged(),
    'username' => $_SESSION["logged_user"],
  );
}
