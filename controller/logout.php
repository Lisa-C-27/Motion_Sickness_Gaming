<?php
    session_start();
?>
<?php
    unset($_SESSION['loggedin']);
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    unset($_SESSION['account']);
    $_SESSION['message'] = "Successfully logged out";
    header("location: ../view/php/login.php");
?>