<?php
//This process is called from 'view/php/register.php' registration form
    session_start();
    include '../model/dbfunctions.php';

    if( isset( $_POST['registration_form'] ) ) {
        
    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

        if ($stmt->rowCount() == 0){

            $username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null;
            $password2 = !empty($_POST['userpass'])? sanitise_input(($_POST['userpass'])): null;
            $password = password_hash($password2, PASSWORD_DEFAULT);
            
            if ($username === null || $password2 === null) {
                $_SESSION['message'] = "Username and password cannot be blank";   
                header('Location: ../view/php/register.php');
            } else {

            $insertuser = "INSERT INTO user (username, password, acctStatus) VALUES (:username, :password, '1')";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertuser);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $userID = $conn->lastInsertID();
            
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userid'] = $userID;
            $_SESSION['account'] = 'active';
            header('location: ../view/php/index.php');
        }
        }else {
            $_SESSION['message'] = "Username already exists";   
            header('Location: ../view/php/register.php');        
        }     
    }
?>
