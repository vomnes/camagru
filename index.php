<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
  </head>
  <body>
    <t1>Sign up<br></t1>
    <form action="welcome.php" method="post">
      Name: <input type="text" name="name"><br>
      E-mail: <input type="text" name="email"><br>
      <input type="submit">
    </form>
    <?php
      include('./server/db.php');
      $bdd = new database();
    ?>
  </body>
</html>
