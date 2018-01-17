<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
  </head>
  <body>
    <t1>Sign up<br></t1>
    <form action="server/control/signin.php" method="POST">
      Name: <input type="text" name="name"><br>
      Password: <input type="text" name="password"><br>
      <input type="submit">
    </form>
    <p><?php
    if ($_GET["code"] == "1") {
      echo "Your account has been created";
    } else if ($_GET["code"] == "2") {
      echo "Please choose another login or email address";
    } else if ($_GET["code"] == "3") {
      echo "Incorrect data";
    }
    ?></p>
  </body>
</html>
