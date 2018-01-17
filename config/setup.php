<?php
  class init {
    private $dbh;

    function __construct() {
      require_once 'db.php';
      $this->dbh = $this->pdo();
      $this->createDB();
      $td = new db();
      $td->execute('create table `Users` (
        id   INT              NOT NULL,
        firstname VARCHAR (20)     NOT NULL,
        lastname VARCHAR (20)     NOT NULL,
        PRIMARY KEY (ID)
      )');
    }

    function pdo() {
      require_once 'database.php';
      try {
        $dbh = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PASSWORD);
      } catch (PDOException $e) { // PDOException
        die('DB ERROR: ' .$e->getMessage());
      }
      return $dbh;
    }

    function createDB() {
      require 'database.php';
      $sql = $this->dbh->exec("CREATE DATABASE `$DB_NAME`;
              CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
              GRANT ALL ON `$DB_NAME`.* TO '$DB_USER'@'localhost';
              FLUSH PRIVILEGES;")
      or die(print('Error: ').print_r($this->dbh->errorInfo(), true));
      echo "Database `$DB_NAME` created <br>";
    }
    function deleteDB() {
      require 'database.php';
      $sql = $this->dbh->exec("DROP DATABASE `$DB_NAME`");
      if ($sql == true) {
        die(print('Error: ').print_r($this->dbh->errorInfo(), true));
      }
      echo "Database `$DB_NAME` deleted <br>";
    }
  }
?>
