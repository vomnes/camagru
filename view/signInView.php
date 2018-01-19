<img class="picture-sign" src="public/pictures/signInPicture.jpg" alt="Sign in">
<div class="sign">
  <h2 style="text-align: center;font-size: 1.7em;">Sign in<br></h2>
  <form action="" method="POST">
    <fieldset>
      <label for="name">Username</label><br><input type="text" name="username"><br>
      <label for="name">Password</label><br><input type="password" name="password"><br>
    </fieldset>
    <p style="text-align: center;"><input class="submit-btm" type="submit" value="Login"></p>
    <p style="text-align: center;"><a id="notYetR" href="index.php?action=passwordforgotten">Forgot your password ?</a> - <a id="notYetR" href="index.php?action=signup">Not yet a registered ?</a></p>
    <?php
    if ($signInCode == 1) {
      echo "<p style=\"text-align: center; color: ForestGreen;\">Your account has been created</p>";
    }
    ?>
  </form>
</div>
