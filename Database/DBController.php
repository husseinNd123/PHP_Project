<?php

class DBController
{
    // Database Connection Properties
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = "barakatDB";

    // connection property
    public $conn = null;

    // call constructor
    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error){
            echo "Fail " . $this->conn->connect_error;
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    // for mysqli closing connection
    protected function closeConnection(){
        if ($this->conn != null ){
            $this->conn->close();
            $this->conn = null;
        }
    }
}

$db = new DBController();
