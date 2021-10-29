<?php 



class Database{
    private $servername = "localhost";
    private $username = "root";
    protected $conn = '';

     function __construct(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=todos", $this->username);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

     function __destruct(){
      $this->conn = null;
    }
}

