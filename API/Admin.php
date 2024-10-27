<?php

require('../Database/DBController.php');

class Admin
{
    public $db = null;
    
    public function __construct(DBController $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    public function getData($table = 'product'){
        $result = $this->db->conn->query("SELECT * FROM {$table}");
        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }
        // echo "API call Succeeded";
        foreach($resultArray as $item){
            echo "<div class='col-lg-4 col-md-6 text-center' id ='".$item['pid']."'".$item['category'].">
            <div class='single-product-item'>
                <div class='product-image'>
                    <a href='single-product.php?id=".$item['pid']."'><img src='".$item['image']."' alt='Product Image'></a>
                </div>
                <h3>".$item['name']."</h3>
                <p class='product-price'>".$item['price']."$</p>
                <a href='cart.php' class='cart-btn'><i class='fas fa-shopping-cart'></i> Add to Cart</a>
                </div>
            </div>";
        }
    }


    // delete product item using product item id
    public function deleteProduct($item_id = null){
        if($item_id != null){
            $result = $this->db->conn->query("DELETE FROM product WHERE pid={$item_id}");
        }
        header('Location: ../shop.php');
    }

    public function addProduct(){        
        $name =  $_POST['name'];
        $price =  $_POST['price'];
        $quantity =  $_POST['quantity'];
        $description =  $_POST['description'];
        $category =  $_POST['category'];
        $image =  $_POST['image'];

        $this->db->conn->query("INSERT INTO product(name,price,quantity,description,category,image,clicks) VALUES( '".$name."', '".$price."', '".$quantity."', '".$description."', '".$category."', '".$image."',0)");
        header('Location: ../shop.php');
    }

    public function updateProduct(){
        $pid = $_POST['pid'];
        $name =  $_POST['name'];
        $price =  $_POST['price'];
        $quantity =  $_POST['quantity'];
        $description =  $_POST['description'];
        $category =  $_POST['category'];
        $image =  $_POST['image'];

        $query = "UPDATE product SET name='".$name."', price=".$price.", quantity=".$quantity.", description='".$description."', category='".$category."', image='".$image."' WHERE pid='$pid'";
        
        echo $query;

        $this->db->conn->query("UPDATE product SET name='".$name."', price=".$price.", quantity=".$quantity.", description='".$description."', category='".$category."', image='".$image."' WHERE pid='$pid'");

        header('Location: ../shop.php');
    }

    public function addCategory($name){
        $this->db->conn->query("INSERT INTO category(category_name) VALUES ('$name')" );
        header('Location: ../admin.php');
    }
    public function trackClick($id){
        $this->db->conn->query("UPDATE product SET clicks=clicks+1 WHERE pid=$id");  
    }

    public function sendContactMail(){
        mail("mohamadhassan.barakat@isae.edu.lb.com",$_POST['subject'],$_POST['message']);
    }


}

$admin = new Admin($db);


if(isset($_POST['add-product'])) $admin->addProduct();
else if(isset($_POST['update-product'])) $admin->updateProduct();
else if(isset($_POST['add-category'])) $admin->addCategory($_POST['name']);
else if(isset($_GET['delete'])) $admin->deleteProduct($_GET['delete']);
else if(isset($_GET['trackClick'])) $admin->trackClick($_GET['trackClick']);
else if(isset($_GET['contact'])) $admin->sendContactMail();
else echo ('API Not Found');



