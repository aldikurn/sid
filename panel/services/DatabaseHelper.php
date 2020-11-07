<?php
class DatabaseHelper
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'sid';
    private $connection = null;


    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
    }

    public function getConnection()
    {
        if ($this->connection == null) {
            $connection =  mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        } else {
            return $this->connection;
        }
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUser()
    {
        return $this->user;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getDB()
    {
        return $this->db;
    }
}
$databaseHelper = new DatabaseHelper();
$conn = new mysqli('localhost', 'root', '', 'sid');