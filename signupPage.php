<?php

    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/auth.css">

</head>
<body>
    <div id="response"></div>

   <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="signup">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input required id="fname" type="text" class="login__input" placeholder="First name">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input required id="lname" type="text" class="login__input" placeholder="Last name">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input required id="username" type="text" class="login__input" placeholder="Username">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input required id="password" type="password" class="login__input" placeholder="Password">
                    </div>
                    <button type="button" id="signup" class="button login__submit">
                        <span class="button__text" >Signup</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <div class="register-signup">
                        <span>
                            Already registered ?  
                            <a href="loginPage.php">Login</a>
                        </span>
                    </div>              
                </form>
                <div class="social-login">
                    <h3>Welcome To Barakat's Shop</h3>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>      
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>      
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $("#signup").on('click',function (){

                var username = $("#username").val();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var password = $("#password").val();

                if(username.length < 3 || password.length < 3){
                    return alert("Username and password should be longer than 3 characters");
                }

                 $.post(
                    {
                        url: 'auth/signup.php',
                        method: 'POST',
                        data: {
                            username : username,
                            password : password,
                            fname: fname,
                            lname: lname,
                        },
                        success: function (response) {
                            if(response.indexOf('Username Already Exists') >= 0){
                                alert('User name already exists Please try another user name');
                            }
                            if(response.indexOf('success') >= 0){
                                window.location.href = './index.php';
                            }
                            else{
                                alert("Something Went Wrong, try again Please")
                            }
                        },
                        dataType: 'text', 
                    }
                );    
            });
        });
    </script>
</body>
</html>