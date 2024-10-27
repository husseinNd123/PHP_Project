<?php
session_start();
require('../Database/DBController.php');


class Checkout
{
    public $db = null;
    
    public function __construct(DBController $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    public function saveOrder($order){
        $order = json_decode($order, true);
        $out = "";
        $flag = 0;
        foreach($order as $item){
            if($flag != 0){
                $out = $out.", ".$item['id']."(".$item['quantity'].")";
                $flag = 1;
            }
            else{
                $out = $out.$item['id']."(".$item['quantity'].")";
            }
        }
        $query = "INSERT INTO orders(user_name,products) VALUES( '".$_SESSION['username']."', '".$out."')";
        $this->db->conn->query($query);
        if($this->db->conn->connect_error){
            exit("Connection failed: " . $this->db->conn->connect_error);
        }

        //update quantity
        for ($i = 0 ; $i < count($order) ; $i++){
            $id = $order[$i]['id'];
            $query = "UPDATE product SET quantity=quantity-".$order[$i]['quantity']." WHERE pid=$id";
            $this->db->conn->query($query);
        }


        exit('{
            "result": "success" 
        }');
    }

    
}
$C = new Checkout($db);
$C->saveOrder(@$_GET['order']);




