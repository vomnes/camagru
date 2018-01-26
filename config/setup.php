<?php
  class init {
    private $dbh;

    function __construct() {
      require_once '../model/db.php';
      $this->dbh = $this->connectionDB();
      $this->createDB();
      $td = new database();
      // User table
      $td->execute('create table `Users` (
        id   INT              NOT NULL AUTO_INCREMENT,
        username VARCHAR (256)     NOT NULL,
        password VARCHAR (256)     NOT NULL,
        email VARCHAR (256) NOT NULL,
        account_validated BIT NULL,
        unique_token VARCHAR (256)     NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        profile_picture VARCHAR (256) DEFAULT "public/pictures/profile/default-profile-picture.png",
        PRIMARY KEY (ID)
      )');
      // Pictures table
      $td->execute('create table `Pictures` (
        id   INT              NOT NULL AUTO_INCREMENT,
        userId INT NOT NULL,
        file_path VARCHAR (256)     NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (ID)
      )');
      // Comments table
      $td->execute('create table `Comments` (
        id   INT              NOT NULL AUTO_INCREMENT,
        pictureId INT NOT NULL,
        userId INT NOT NULL,
        content TEXT NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (ID)
      )');
      // Likes table
      $td->execute('create table `Likes` (
        id   INT              NOT NULL AUTO_INCREMENT,
        pictureId INT NOT NULL,
        userId INT NOT NULL,
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (ID)
      )');
      $td->insertData(
        'Users',
        'username, password, email, unique_token',
        ':username, :password, :email, :unique_token',
        array(
          'username' => "valentin",
          'password' => hash('whirlpool', "valentin"),
          'email' => 'valentin.omnes@gmail.com',
          'unique_token' => 'abcdef',
        ));
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
