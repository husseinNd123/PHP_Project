<?php
session_start();
require('../Database/DBController.php');

class Product
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
             
        shuffle($resultArray);
        foreach($resultArray as $item){
            if(isset($_SESSION['admin'])){
                $admin = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./admin.php?update='.$item['pid'].'" id="editProduct"><i class="fa fa-pen"></i></a> &nbsp;&nbsp;&nbsp; <a id="deleteProduct" data-id="'.$item['pid'].'"><i class="fa fa-trash"></i></a>';
            }
            else $admin='';
            $btn = "<a onClick='addToCart(".$item['pid'].")' class='cart-btn'><i class='fas fa-shopping-cart'></i> Add to Cart</a>";
            if($item['quantity'] <= 0)
                $btn = "<button disabled class='cart-btn-disabled'>Out Of Stock!</button>";

            echo " <div class='col-lg-4 col-md-6 text-center' id ='".$item['pid']."'>
            <div class='single-product-item'>
                <div class='product-image'>
                    <a href='single-product.php?id=".$item['pid']. "'><img src='".$item['image']."' alt='Product Image'></a>
                </div>
                <h3>".$item['name']."</h3>
                <p class='product-price'>".$item['price']."$</p>
                $btn
                $admin
                </div>
            </div>";
        }
    }

    public function getProducts($order){

        $order = json_decode($order, true);
        $idList = array();

        foreach($order as $item){
           array_push($idList, $item['id']);
        }

        $idList = implode(',', array_unique(array_map('intval', $idList)));
        $query = "select * from product WHERE `pid` IN ($idList)";
        $result = $this->db->conn->query($query);
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $out = "";
        $subtotal=0;
        for($i = 0 ; $i < count($items) ; $i++){
            $subtotal += $items[$i]['price'] * $order[$i]['quantity'];
            $out .= '<tr class=\"table-body-row\">\r\n                    <td class=\"product-remove\"><a onClick=\"removeFromCart('.$items[$i]['pid'].')\" >X<\/a><\/td>\r\n                    <td class=\"product-image\"><img src='.$items[$i]['image'].' alt=\"product image\"><\/td>\r\n                    <td class=\"product-name\">'.$items[$i]['name'].'<\/td>\r\n                    <td class=\"product-price\">$'.$items[$i]['price'].'<\/td>\r\n                    <td class=\"product-quantity\">'.$order[$i]['quantity'].'<\/td>\r\n                    <td class=\"product-total\">$'.$items[$i]['price']*$order[$i]['quantity'].'<\/td>\r\n                 <\/tr>';
        }

        exit('{
            "out": "'.$out.'",
            "subtotal": "'.$subtotal.'"
        }');

    }


    // get product using item id
    public function getProductById($item_id = null, $table= 'product'){
        if (isset($item_id)){
            $result = $this->db->conn->query("SELECT * FROM {$table} WHERE pid={$item_id}");

            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            $item = $resultArray[0];
            echo '<div class="col-md-5">
                    <div class="single-product-img">    
                        <img src= "'.$item['image'].'" alt="">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>Green apples have polyphenols</h3>
                        <p class="single-product-pricing"> '.$item['price'].'$</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta sint dignissimos, rem commodi cum voluptatem quae reprehenderit repudiandae ea tempora incidunt ipsa, quisquam animi perferendis eos eum modi! Tempora, earum.</p>
                        <div class="single-product-form">
                            <p><strong>Category: </strong><em>'.$item['category'].'</em></p>
                            <a onClick="addToCart('.$item['pid'].')" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                </div>';
        }
    }

    // get product using category name
    public function getProductsByCategoryName($cname = null, $table= 'product'){
        if($cname == 'all'){
            $this->getData();
            return;
        } 
        $result = $this->db->conn->query("SELECT * FROM $table WHERE category='$cname'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        foreach($resultArray as $item){
            if(isset($_SESSION['admin'])){
                $admin = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./admin.php?update='.$item['pid'].'" id="editProduct"><i class="fa fa-pen"></i></a> &nbsp;&nbsp;&nbsp; <a id="deleteProduct" data-id="'.$item['pid'].'"><i class="fa fa-trash"></i></a>';
            }
            else $admin='';
            $btn = "<a onClick='addToCart(".$item['pid'].")' class='cart-btn'><i class='fas fa-shopping-cart'></i> Add to Cart</a>";
            if($item['quantity'] <= 0)
                $btn = "<button disabled class='cart-btn-disabled'>Out Of Stock!</button>";
            echo "<div class='col-lg-4 col-md-6 text-center' id ='".$item['pid']."'".$item['category'].">
            <div class='single-product-item'>
                <div class='product-image'>
                    <a href='single-product.php?id=".$item['pid']."'><img src='".$item['image']."' alt='Product Image'></a>
                </div>
                <h3>".$item['name']."</h3>
                <p class='product-price'>".$item['price']."$</p>
                $btn
                $admin
                </div>
            </div>";
        }
    }




}

$P = new Product($db);


if(isset($_GET['getAllProducts'])) $P->getProductsByCategoryName($_GET['cat']);
else if(isset($_GET['getProductById'])) $P->getProductById($_GET['id']);
else if(isset($_GET['getProducts'])) $P->getProducts($_GET['order']);
else echo "API Not Found";

