<?php
  include("../db.php");
  $bdd = new database();
  function userExists($data, $fieldName, $name) {
    $dataLen = count($data);
    for($i = 0; $i < $dataLen; $i++) {
      if ($data[$i][$fieldName] == $name) {
        return true;
      }
    }
    return false;
  }

  if ($name != '' && $pw != '') {
    $data = $bdd->getAll('SELECT Firstname FROM Users');
    print(userExists($data, 'Firstsname', $name));
    if (!userExists($data, 'Firstname', $name)) {
      $bdd->insertData('Users', 'Firstname, Lastname', ':firstname, :lastname', array('firstname' => $name, 'lastname' => $pw));
      // User created
      header("Location: ../..?code=1");
    } else {
      // User already exists
      header("Location: ../..?code=2");
    }
  }
  // Wrong input
  header("Location: ../..?code=3");
?>
