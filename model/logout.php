<?php
    session_start();
?>
<?php
    unset($_SESSION['loggedin']);
    header("location: ../view/php/index.php");
?>