
<?php
    session_start();

    unset($_SESSION['loggedIN']);
    unset($_SESSION['username']);
    if(isset($_SESSION['admin']))
    unset($_SESSION['admin']);
    session_destroy();
    header('Location: ../../loginPage.php');

?>