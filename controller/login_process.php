<?php
    session_start();
?>
<?php

    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($stmt->rowCount() == 1){
        
        if ($result['acctStatus'] == '3') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userID'];
            $_SESSION['account'] = "admin";
            header('location: ../view/php/index.php');
            
        } else if ($result['acctStatus'] == '1') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userID'];
            $_SESSION['account'] = "active";
            header('location: ../view/php/index.php');
            
        } else if ($result['acctStatus'] == '2') {
           $_SESSION['message'] = "Login Error: Account has been disabled";
            header('location: ../view/php/login.php');
        }
    } else {
        $_SESSION['message'] = "Login Error: Incorrect username or password";
        header("location: ../view/php/login.php");      
    }

?>
