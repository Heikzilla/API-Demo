<?php
/**
 * Created by PhpStorm.
 * User: heikel
 * Date: 12.11.18
 * Time: 14:09
 */

class Database{

    //PDO Settings
    private $host = 'localhost';
    private $db_name = 'api_db';
    private $user = 'root';
    private $password = '';
    public $conn;

    // connect to Database
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>