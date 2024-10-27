<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/auth.css">

</head>
<body>
   <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input required type="text" id="username" name="username" class="login__input" placeholder="Username">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input required type="password" id="password" name="password" class="login__input" placeholder="Password">
                    </div>
                    <button type="button" id="login" class="button login__submit">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                    <div class="register-signup">
                        <span>
                            Don't have an account ? 
                            <a href="signupPage.php">Sign up</a>
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
            $("#login").on('click',function (){
                var username = $("#username").val();
                var password = $("#password").val();

                if(username.length < 3 || password.length < 3){
                    return alert("Username and password should be longer than 3 characters");
                }
                
                 $.ajax(
                    {
                        url: 'auth/login.php',
                        method: 'POST',
                        data: {
                            username : username,
                            password : password, 
                        },
                        success: function (response) {
                            if(response.indexOf('success') >= 0){
                                window.location.href = './index.php';
                            }
                            else{
                                alert("Please check your credentials and try again");
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