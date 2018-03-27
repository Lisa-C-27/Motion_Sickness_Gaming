<?php
    session_start();

    if( isset( $_POST['registration_form'] ) ) {
        
    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

        if ($stmt->rowCount() == 0){

            $username = $_POST['username'];
            $password = $_POST['userpass'];

            $insertuser = "INSERT INTO user (username, password, acctStatus) VALUES( '$username','$password','2' )";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertuser);
            $stmt->execute();
            
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userid'] = $result['user_ID'];
            $_SESSION['account'] = 'active';
            header('location: ../view/php/index.php');
            } else {
            $_SESSION['message'] = "Username already exists";   
            header('Location: ../view/php/register.php');        
            }     
    }
?>
