<?php
  class init {
    private $dbh;

    function __construct() {
      require_once '../server/db.php';
      $this->dbh = $this->connectionDB();
      $this->createDB();
      $td = new database();
      $td->execute('create table `Users` (
        Id   INT              NOT NULL AUTO_INCREMENT,
        Firstname VARCHAR (20)     NOT NULL,
        Lastname VARCHAR (20)     NOT NULL,
        PRIMARY KEY (ID)
      )');
      $td->insertData('Users', 'Firstname, Lastname', ':firstname, :lastname', array('firstname' => "bonjour", 'lastname' => "hello"));
    }

    // Establish a connection the connection with mySQL
    function connectionDB() {
      require_once 'database.php';
      try {
        $dbh = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PASSWORD);
      } catch (PDOException $e) { // PDOException
        die('DB ERROR : ' .$e->getMessage());
      }
      return $dbh;
    }

    // Create the database named using $DB_NAME
    function createDB() {
      require 'database.php';
      $sql = $this->dbh->exec("CREATE DATABASE `$DB_NAME`;
              CREATE USER '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
              GRANT ALL ON `$DB_NAME`.* TO '$DB_USER'@'localhost';
              FLUSH PRIVILEGES;")
      or die(print('Error - createDB: ').print_r($this->dbh->errorInfo(), true));
      echo "Database `$DB_NAME` created <br>";
    }

    // Delete the database $DB_NAME
    function deleteDB() {
      require 'database.php';
      $sql = $this->dbh->exec("DROP DATABASE `$DB_NAME`")
      or die(print('Error - deleteDB: ').print_r($this->dbh->errorInfo(), true));
      echo "Database `$DB_NAME` deleted <br>";
    }
  }
?>