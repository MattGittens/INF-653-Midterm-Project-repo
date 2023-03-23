<?php
class Database{
    //DB Params
    private $host = 'dpg-cgdqv002qv2bbhl90qb0-a';
    private $port = '5432';
    private $db_name = 'quotesdb_tsjq';
    private $username = 'quotesdb_tsjq';
    private $password = 'quotesdb_tsjq_user';
    private $conn;

    // DB Connect
    public function connect(){
        $this ->conn = null;
        $dsn = "pgsql:host={$this->host};port={this->port};dbname={$this->db_name}";


        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
} 
