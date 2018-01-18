<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
  </head>
  <body>
    <t1>Sign up<br></t1>
    <form action="" method="POST">
      Name: <input type="text" name="username"><br>
      Password: <input type="password" name="password"><br>
      Email address: <input type="text" name="email"><br>
      <input type="submit">
    </form>
    <p><?php
    if ($signUpCode == 1) {
      echo "Your account has been created";
    } else if ($signUpCode == 2) {
      echo "Please choose another login or email address";
    } else if ($signUpCode == 3) {
      echo "Username must not be empty";
    } else if ($signUpCode == 4) {
      echo "Password must not be empty";
    } else if ($signUpCode == 5) {
      echo "Email address must not be empty";
    }
    ?></p>
  </body>
</html>
