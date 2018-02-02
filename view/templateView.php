<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="x-ua-compatible" content="ie=edge"> †
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/content.css">
    <link rel="stylesheet" type="text/css" href="public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="public/css/gallery.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
    <link rel="stylesheet" type="text/css" href="public/css/camera.css">
    <script src="public/js/header.js"></script>
    <link rel="me" href="mailto:valentin.omnes@gmail.com">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/pictures/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Belgrano" rel="stylesheet">
  </head>
  <body>
    <div id="topnav">
        <a id="camagru-logo" href="index.php"><img src="/public/pictures/photo-camera-128.png" alt="logo" width="64" height="64" border="0" title="Camagru logo"></a>
        <a id="camagru-text" href="index.php">Camagru</a>
        <h2 id="title-page-header"></h2>
        <?php if ($data['isLogged']) { ?>
        <a id="btm-description"></a>
        <a id="camera-btm" href="index.php?action=camera" onmouseover="mouseTitle('visible', 'Manage pictures')" onmouseout="mouseTitle('hidden', '')"><img title="Manage pictures" src="/public/pictures/camera-128.png" alt="camera logo" width="30" height="30" border="0"></a>
        <a id="gallery-btm" href="index.php?action=gallery" onmouseover="mouseTitle('visible', 'See the gallery')" onmouseout="mouseTitle('hidden', '')"><img title="See the gallery" src="/public/pictures/gallery-128.png" alt="gallery logo" width="30" height="30" border="0"></a>
        <a id="profile-btm" href="index.php?action=myprofile" onmouseover="mouseTitle('visible', '<?php echo ucfirst($data["username"]); ?>\'s Profile')" onmouseout="mouseTitle('hidden', '')"><img title="Edit profile" src="/public/pictures/profile-128.png" alt="profile logo" width="30" height="30" border="0"></a>
        <a id="logout-btm" href="index.php?action=logout" onmouseover="mouseTitle('visible', 'Logout')" onmouseout="mouseTitle('hidden', '')"><img title="Logout" src="/public/pictures/logout-128.png" alt="logout logo" width="35" height="35" border="0"></a>
        <!-- Under 725px width menu -->
        <img id="open-mobile-menu" title="Mobile menu" src="/public/pictures/menu-mobile-128.png" alt="logout logo" width="35" height="35" border="0">
        <div id="mobile-menu">
          <div class="element-menu">
            <a id="" href="index.php?action=camera">
            <img title="Manage pictures" src="/public/pictures/camera-128.png" alt="camera logo" width="15" height="15" border="0">
            Manage pictures</a>
          </div>
          <div class="element-menu">
            <a id="" href="index.php?action=gallery">
            <img title="See the gallery" src="/public/pictures/gallery-128.png" alt="gallery logo" width="15" height="15" border="0">
            See the gallery</a>
          </div>
          <div class="element-menu">
            <a id="" href="index.php?action=myprofile">
            <img title="Edit profile" src="/public/pictures/profile-128.png" alt="profile logo" width="15" height="15" border="0">
            <?php echo ucfirst($data["username"]); ?>'s Profile</a>
          </div>
          <div class="element-menu">
            <a id="" href="index.php?action=logout">
            <img title="Logout" src="/public/pictures/logout-128.png" alt="logout logo" width="15" height="15" border="0">
            Logout</a>
          </div>
        </div>
        <? } ?>
    </div>
    <div class="container" id="id-container">
      <?php echo $content;?>
      <footer>
          <!-- <a href="#">Created by Valentin Omnès - All Rights Reserved.</a> -->
      </footer>
    </div>
  </body>
</html>
