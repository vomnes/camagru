<img class="picture-sign" src="public/pictures/signInPicture.jpg" alt="Sign in">
<div class="sign">
  <h2 style="text-align: center;font-size: 1.7em;">Sign in<br></h2>
  <form action="" method="POST">
    <fieldset>
      <label for="name">Username</label><br><input type="text" name="username" maxlength="64" required><br>
      <label for="name">Password</label><br><input type="password" name="password" maxlength="255" required><br>
    </fieldset>
    <p style="text-align: center;"><input class="submit-btm" type="submit" value="Login"></p>
    <?php
    if ($signInCode == 1) {
      header('Location: index.php');
    } else if ($signInCode == -1) {
      echo "<p style=\"text-align: center; color: Brown;\">Account not yet validated</p>";
    } else if ($signInCode == -2) {
      echo "<p style=\"text-align: center; color: Brown;\">Wrong username or password</p>";
    } else if ($signInCode == -3) {
      echo "<p style=\"text-align: center; color: Brown;\">Username can not be empty</p>";
    } else if ($signInCode == -4) {
      echo "<p style=\"text-align: center; color: Brown;\">Password can not be empty</p>";
    }
    ?>
    <p style="text-align: center;"><a id="notYetR" href="index.php?action=passwordforgotten">Forgot your password ?</a> - <a id="notYetR" href="index.php?action=signup">Not yet a registered ?</a></p>
  </form>
</div>
