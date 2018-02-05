<img class="picture-sign" src="public/pictures/passwordForgotten.jpg" alt="Activate">
<div class="sign">
<h2 style="text-align: center;font-size: 1.7em;">Forgot your password ?</h2>
  <form action="" method="POST">
    <fieldset>
      <label for="name">Please enter your <u>username</u>.<br>A reset password link<br>will be sent to your<br>email address.<br><br></label><input type="text" name="username" maxlength="64" required><br>
    </fieldset>
    <p style="text-align: center;"><input class="submit-btm" type="submit" value="Send"></p>
    <?php
    if ($code == 1) {
      echo "<p style=\"text-align: center; color: ForestGreen;\">An email has been sent to you</p>";
    } else if ($code == -1) {
      echo "<p style=\"text-align: center; color: Brown;\">Account not yet validated</p>";
    } else if ($code == -2) {
      echo "<p style=\"text-align: center; color: Brown;\">No account with this username</p>";
    } else if ($code == -3) {
      echo "<p style=\"text-align: center; color: Brown;\">An error has occured please contact us</p>";
    }
    ?>
  </form>
</div>
