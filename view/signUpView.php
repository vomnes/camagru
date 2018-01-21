   <img class="picture-sign" src="public/pictures/signUpPicture.jpg" alt="Vintage camera">
   <div class="sign">
     <h2 style="text-align: center;font-size: 1.7em;">Sign up<br></h2>
     <form action="" method="POST">
       <fieldset>
         <label for="name">Username</label><br><input type="text" name="username" maxlength="64" required><br>
         <label for="name">Password</label><br><input type="password" name="password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
         <label for="name">Re-enter password</label><br><input type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
         <label for="name">Email address</label><br><input type="email" name="email" maxlength="128" required><br>
       </fieldset>
       <p style="text-align: center;"><input class="submit-btm" type="submit" value="Registered"></p>
       <?php
       if ($signUpCode == 1) {
         echo "<p style=\"text-align: center; color: ForestGreen;\">Your account has been created<br>You will be receiving an email at<br>".$_POST["email"]."<br>with the activation URL</p>";
       } else if ($signUpCode == -3) {
         echo "<p style=\"text-align: center; color: Brown;\">Please choose another username</p>";
       } else if ($signUpCode == -2) {
         echo "<p style=\"text-align: center; color: Brown;\">The two passwords must be identical</p>";
       } else if ($signUpCode == -1) {
         echo "<p style=\"text-align: center; color: Brown;\">An error has occured</p>";
       } else if ($signUpCode == -4) {
         echo "<p style=\"text-align: center; color: Brown;\">Fields with limits, please respect the warnings/p>";
       }
       ?>
     </form>
   </div>

<!-- Need to check length max 255, min 8, email pattern and password pattern -->
