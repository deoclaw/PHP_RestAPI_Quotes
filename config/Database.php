<?php
class Database {
    //This class creates a database connection
    //DB Params
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;
    private $conn;

    //constructor to get our environment variables in the htaccess file
    public function __construct() {
        $this->host = getenv('HOST');
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->db_name = getenv('DBNAME');
        $this->port = getenv('DBPORT');
    }

    //DB Connect
    public function connect(){
        $this->conn = null;

        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

        //create new PDO object to try and connect
        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {

            echo "Connection error: ".$e->getMessage();
        }

        return $this->conn;
    }
}