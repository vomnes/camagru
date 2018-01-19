<?php
  class init {
    private $dbh;

    function __construct() {
      require_once '../model/db.php';
      $this->dbh = $this->connectionDB();
      $this->createDB();
      $td = new database();
      $td->execute('create table `Users` (
        id   INT              NOT NULL AUTO_INCREMENT,
        username VARCHAR (20)     NOT NULL,
        password VARCHAR (128)     NOT NULL,
        email VARCHAR (128) NOT NULL,
        account_validated BIT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (ID)
      )');
      $td->insertData('Users', 'username, password, email', ':username, :password, :email', array('username' => "admin", 'password' => hash('whirlpool', "admin"), 'email' => 'admin@camagru.co'));
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
