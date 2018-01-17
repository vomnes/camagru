<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
  </head>
  <body>
    <t1>I'm Valentin OMNES<br></t1>
    <?php
      include('config/db.php');
      include('config/setup.php');
      $create = new init();
      $bdd = new db();
      // $User = $bdd->getOne('SELECT id, firstname, lastname FROM users WHERE lastname = "Smith"'); // 1 line selection, return 1 line
      // echo $User['id'].'<br>'; // display the id
      // echo $User['firstname'].'<br>'; // display the first name
      // echo $User['lastname']; // display the last name
      $create->deleteDB();
    ?>
  </body>
</html>
