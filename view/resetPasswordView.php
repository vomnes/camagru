<img class="picture-sign" src="public/pictures/resetPassword.jpg" alt="Activate">
<div class="sign">
<h2 style="text-align: center;font-size: 1.7em;">Reset password</h2>
  <form action="" method="POST">
    <fieldset>
      <label for="name">New password</label><br><input type="password" name="password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
      <label for="name">Re-enter new password</label><br><input type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
    </fieldset>
    <p style="text-align: center;"><input class="submit-btm" type="submit" value="Update"></p>
    <?php
    if ($code == 1) {
      echo "<p style=\"text-align: center; color: ForestGreen;\">Password updated</p>";
    } else if ($code == -2) {
      echo "<p style=\"text-align: center; color: Brown;\">The two passwords must be identical</p>";
    } else if ($code == -3) {
      echo "<p style=\"text-align: center; color: Brown;\">Fields with limits, please respect the warnings</p>";
    } else if ($code == -4) {
      echo "<p style=\"text-align: center; color: Brown;\">Must contain between 8 and 254 characters with only digits, uppercase<br>and lowercase characters</p>";
    }
    ?>
  </form>
</div>
