<?php
class DB {
    protected $db;

    function __construct(){
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_dbname = "php_stock_db";

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_dbname", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        } catch (PDOExceotion $e) {
            echo "Connection failed: ". $e->getMessage();
            die();
        }
    }

}
?>