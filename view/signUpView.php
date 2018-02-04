   <img class="picture-sign" src="public/pictures/signUpPicture.jpg" alt="Vintage camera">
   <div class="sign">
     <h2 style="text-align: center;font-size: 1.7em;">Sign up<br></h2>
     <form action="" method="POST">
       <fieldset>
         <label for="name">Username</label><br><input type="text" name="username" minlength="4" maxlength="64" pattern="(?=.*[a-z])[0-9a-zA-Z]{4,64}" title="Username must be between 8 and 64 characters and contain only lowercase and uppercase characters and digit" required><br>
         <label for="name">Password</label><br><input type="password" name="password" maxlength="254" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,254}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
         <label for="name">Re-enter password</label><br><input type="password" name="re-password" maxlength="254" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,254}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
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
         echo "<p style=\"text-align: center; color: Brown;\">An error has occured please contact use</p>";
       } else if ($signUpCode == -4) {
         echo "<p style=\"text-align: center; color: Brown;\">Fields with limits, please respect the warnings</p>";
       } else if ($signUpCode == -5) {
         echo "<p style=\"text-align: center; color: Brown;\">Not a valid email address</p>";
       } else if ($signUpCode == -6) {
         echo "<p style=\"text-align: center; color: Brown;\">Must contain at least one number and one uppercase<br>and lowercase letter, and at least 8 or more characters</p>";
       } else if ($signUpCode == -7) {
         echo "<p style=\"text-align: center; color: Brown;\">Not a valid username<br>Must contain between 4 and 64 characters of only lowercase, uppercase and digits</p>";
       }
       ?>
     </form>
   </div>
