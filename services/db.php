<?php
class DB {
    protected $db;

    function __construct(){
        $db_host = "us-cdbr-east-06.cleardb.net";
        $db_username = "b64e841bbd6ce3";
        $db_password = "c6ffd493";
        $db_dbname = "heroku_0995468ce18ab19";

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