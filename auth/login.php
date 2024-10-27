<?php

    session_start();
    require('../Database/DBController.php');
    if($db->conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_SESSION["loggedIN"])){
        exit("success");
    }

    $username = $_POST['username'];
    $pass = $_POST['password'];

    $username = $db->conn->real_escape_string($username);
    $pass = $db->conn->real_escape_string($pass);
    
    
    $adminAuthQuery = "SELECT user_name , password FROM admin WHERE user_name = '$username' AND password = '$pass'";
    $data = $db->conn->query($adminAuthQuery);

    if($data){  
        if($data->num_rows > 0){
            $_SESSION['admin'] = true;
            $_SESSION['loggedIN'] = true;
            $_SESSION['username'] = $username;
            exit("success");
        }
        else{
            $userAuthQuery = "SELECT user_name , password FROM user WHERE user_name = '$username' AND password = '$pass'";
            $data = $db->conn->query($userAuthQuery);
            if($data){
                if($data->num_rows > 0){
                    $_SESSION['loggedIN'] = true;
                    $_SESSION['username'] = $username;
                    exit("success");
                }
                else{
                    exit("Invalid username or passsword");
                }
            }
            else{
                exit("No Data Found");
            }
        }
    }
    else{
        exit("No Data Found");
    }
    
?>
