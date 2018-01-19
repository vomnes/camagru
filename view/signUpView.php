   <img class="picture-sign" src="public/pictures/signUpPicture.jpg" alt="Open 24 hours">
   <div class="sign">
     <h2 style="text-align: center;font-size: 1.7em;">Sign up<br></h2>
     <form action="" method="POST">
       <fieldset>
         <label for="name">Username: </label><br><input type="text" name="username"><br>
         <label for="name">Password: </label><br><input type="password" name="password"><br>
         <label for="name">Re-enter password </label><br><input type="password2" name="password"><br>
         <label for="name">Email address: </label><br><input type="text" name="email"><br>
       </fieldset>
       <p style="text-align: center;"><input class="submit-btm" type="submit"></p>
       <?php
       if ($signUpCode == 1) {
         echo "<p style=\"text-align: center; color: ForestGreen;\">Your account has been created</p>";
       } else if ($signUpCode == 2) {
         echo "<p style=\"text-align: center; color: Brown;\">Please choose another login or email address</p>";
       } else if ($signUpCode == 3) {
         echo "<p style=\"text-align: center; color: Brown;\">Username must not be empty</p>";
       } else if ($signUpCode == 4) {
         echo "<p style=\"text-align: center; color: Brown;\">Password must not be empty</p>";
       } else if ($signUpCode == 5) {
         echo "<p style=\"text-align: center; color: Brown;\">Email address must not be empty</p>";
       }
       ?>
     </form>
   </div>
