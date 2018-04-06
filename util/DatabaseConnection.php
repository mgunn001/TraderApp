<?php
class DatabaseConnection
{

// Database details
//for Remote
    // private $host = "handson-mysql";
    // private $db_name = "Trader";
    // private $username = "user";
    // private $password = "handson1234";

    private $host = "localhost";
    private $db_name = "Trader";
    private $username = "root";
    private $password = "";


    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        // Create connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>
