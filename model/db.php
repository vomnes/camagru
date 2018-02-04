<?php
    class database {
      private $DB_CONN;
    	private $DB_PORT;
    	private $DB_DEBUG;
      public $DB_ERROR;

      function __construct($params=array()) {
        $this->DB_PORT = '3306';
        $this->DB_DEBUG = true;
        $this->DB_CONN = false;
        // $this->$DB_ERROR = 0;
        $this->connect();
      }

      function __destruct() {
        $this->disconnect();
      }

      function connect() {
        require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
        if (!$this->DB_CONN) {
          try {
            $this->DB_CONN = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
          } catch (Exception $e) {
            http_response_code(500);
            echo $this->handleError($e, __FUNCTION__);
            die();
          }
          if (!$this->DB_CONN) {
            $this->status_fatal = true;
            echo 'Connection BDD failed';
            http_response_code(500);
            echo $this->handleError($e, __FUNCTION__);
            die();
          }
          else {
            $this->status_fatal = false;
          }
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
        try {
          $result->execute();
        } catch (Exception $e) {
          throw new \Exception($this->handleError($e, __FUNCTION__));
        }
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $reponse = $result->fetch();
        return $reponse;
      }

      function insertData($tableName, $fields, $values, array $content) {
        $result = $this->DB_CONN->prepare('INSERT INTO '.$tableName.'('.$fields.')'.' VALUES('.$values.')');
        try {
          $result->execute($content);
        } catch (Exception $e) {
          throw new \Exception($this->handleError($e, __FUNCTION__));
        }
      }

      function updateData($query) {
        $result = $this->DB_CONN->prepare($query);
        try {
          $result->execute();
        } catch (Exception $e) {
          throw new \Exception($this->handleError($e, __FUNCTION__));
        }
      }

      function deleteData($query) {
        $result = $this->DB_CONN->prepare($query);
        try {
          $result->execute();
        } catch (Exception $e) {
          throw new \Exception($this->handleError($e, __FUNCTION__));
        }
      }

      function getAll($query) {
        $result = $this->DB_CONN->prepare($query);
        try {
          $result->execute();
        } catch (Exception $e) {
          throw new \Exception($this->handleError($e, __FUNCTION__));
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
                return $response;
            }
        }
        return $response;
      }

      private function handleError($e, $functionName) {
        $error = array();
        $error['Status'] = "Error";
        $file = preg_replace('/^.*\/\s*/', '', $e->getFile());
        $error['Declared'] = $file . '[' . $functionName . '()]';
        $trace = $e->getTrace();
        if (count($trace) >= 2){
          $realFile = preg_replace('/^.*\/\s*/', '', $trace[1]['file']);
          $error['Used'] = $realFile . ':' . $trace[1]['line'];
        }
        $error['Message'] = $e->getMessage();
        return json_encode($error);
      }
    }
?>
