<?php

class Database
{
    /*
     * database connection variables
     */
    private $host = "localhost";
    private $bd_name = "PHPFundamentsla";
    private $username = "root";
    private $pass = "root";
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}