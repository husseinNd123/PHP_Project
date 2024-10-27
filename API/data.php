<?php
session_start();
require('../Database/DBController.php');

class Data
{
    public $db = null;
    
    public function __construct(DBController $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    public function getData1($table= 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table}");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }   
        header('Content-Type: application/json');
        echo json_encode($resultArray);
    }
}


$D = new Data($db);

if (isset($_GET['getData1'])) {
    $D->getData1();
}