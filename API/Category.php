<?php
session_start();
require('../Database/DBController.php');
class Category{
 
    // database connection and table name
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->conn)) return null;
        $this->db = $db;
    }

    public function getCategories(){
        $result = $this->db->conn->query("SELECT * FROM category");
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $category = @$_GET['cat'];
        echo '<li>
                <a href="shop.php">All</a>
              </li>';
        foreach($result as $cat){
            echo '<li>
                    <a href="shop.php?cat='.$cat['category_name'].'">'.$cat['category_name'].'</a>
                  </li>';  
        }
    }
}

$C = new Category($db);
if(isset($_GET['getCategories'])) $C->getCategories();


