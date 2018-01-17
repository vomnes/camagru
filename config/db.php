<?php
    class db {
      private $DB_CONN;
    	private $DB_PORT;
    	private $DB_DEBUG;

      function __construct($params=array()) {
        $this->DB_PORT = '3306';
        $this->DB_DEBUG = true;
        $this->DB_CONN = false;
        $this->connect();
      }

      function __destruct() {
        $this->disconnect();
      }

      function connect() {
        require 'database.php';
        if (!$this->DB_CONN) {
          try {
            $this->DB_CONN = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
          }
          catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
          }
          if (!$this->DB_CONN) {
            $this->status_fatal = true;
            echo 'Connection BDD failed';
            die();
          }
          else {
            $this->status_fatal = false;
          }
        }
        if($this->DB_CONN){
          echo "Connection sucessfull <br>";
        }
        return $this->DB_CONN;
      }

      function disconnect() {
        if ($this->DB_CONN) {
          $this->DB_CONN = null;
        }
      }

      function getOne($query) {
        $result = $this->DB_CONN->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
           echo 'PDO::errorInfo():';
           echo '<br />';
           echo 'error SQL: '.$query;
           die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetch();
        return $reponse;
      }

      function getAll($query) {
        $result = $this->DB_CONN->prepare($query);
        $ret = $result->execute();
        if (!$ret) {
           echo 'PDO::errorInfo():';
           echo '<br />';
           echo 'error SQL: '.$query;
           die();
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetchAll();
        return $reponse;
      }

      function execute($query) {
        $response = $this->DB_CONN->exec($query);
        if ($response === false) {
            $DB_ERROR = $this->DB_CONN->errorInfo();
            if ($DB_ERROR[0] === '00000' || $DB_ERROR[0] === '01000') {
                return true;
            } else {
                echo 'PDO::errorInfo():';
                echo '<br />';
                echo 'error SQL: '.$query;
                echo $response;
                die();
            }
        }
        echo 'The sites table is created <br>';
        return $response;
      }
    }
?>
