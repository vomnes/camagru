<?php if ($accountIsActivated > 0) { ?>
  <img class="picture-sign" src="public/pictures/activatePicture.jpg" alt="Activate">
<?php } else { ?>
  <img class="picture-sign" src="public/pictures/camagru-home.png" alt="Sign in">
<?php } ?>
  <div class="sign">
  <?php if ($accountIsActivated == 1) { ?>
    <h2 style="text-align: center;font-size: 1.7em;">Your account has been<br>successfully activated !<br><br>You can now login :</h2>
  <?php } elseif ($accountIsActivated == 2) { ?>
    <h2 style="text-align: center;font-size: 1.7em;">Your account has <br><i>already</i> been activated.<br><br>You can login :</h2>
  <?php } else { ?>
    <h2 style="text-align: center;font-size: 1.7em;">Sign in<br></h2>
  <?php } ?>
  <form action="" method="POST">
    <fieldset>
      <label for="name">Username</label><br><input type="text" name="username" maxlength="64" required><br>
      <label for="name">Password</label><br><input type="password" name="password" maxlength="255" required><br>
    </fieldset>
    <p style="text-align: center;"><input class="submit-btm" type="submit" value="Login"></p>
    <?php
    $signInCode = $signInData["code"];
    if ($signInCode == 1) {
      header('Location: index.php?code=1');
    } else if ($signInCode == -1) {
      echo "<p style=\"text-align: center; color: Brown;\">Account not yet validated<br>An email has been sent to<br><u>".$signInData["accountEmail"]."</u><br>with the activation URL</p>";
    } else if ($signInCode == -2) {
      echo "<p style=\"text-align: center; color: Brown;\">Wrong username or password</p>";
    } else if ($signInCode == -3) {
      echo "<p style=\"text-align: center; color: Brown;\">Username can not be empty</p>";
    } else if ($signInCode == -4) {
      echo "<p style=\"text-align: center; color: Brown;\">Password can not be empty</p>";
    }
    ?>
    <?php if ($accountIsActivated == 0) { ?>
      <p style="text-align: center;"><a id="notYetR" href="index.php?action=passwordforgotten">Forgot your password ?</a> - <a id="notYetR" href="index.php?action=signup">Not yet a registered ?</a></p>
    <?php } ?>
  </form>
</div>
