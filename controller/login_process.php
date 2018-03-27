<?php
//This process is called from 'view/php/login.php' login form
    session_start();
?>
<?php

    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($stmt->rowCount() == 1){
        
        //This sets session as admin. Admin will be able to delete comments
        if ($result['acctStatus'] == '3') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userID'];
            $_SESSION['account'] = "admin";
            header('location: ../view/php/index.php');
            
        //This sets session as active. Active/registered users can add games/fixes/comments
        } else if ($result['acctStatus'] == '1') {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userID'];
            $_SESSION['account'] = "active";
            header('location: ../view/php/index.php');
          
        //If a disabled account tries to login it will display that the account is disabled
        } else if ($result['acctStatus'] == '2') {
           $_SESSION['message'] = "Login Error: Account has been disabled";
            header('location: ../view/php/login.php');
        }
        
        //If unknown user or incorrect details entered display message
    } else {
        $_SESSION['message'] = "Login Error: Incorrect username or password";
        header("location: ../view/php/login.php");      
    }

?>
