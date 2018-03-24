<?php

    if( isset( $_POST['registration_form'] ) ) {

        $username = $_POST['user_name'];
        $password = $_POST['user_pass'];

        $insertuser = "INSERT INTO user (username, password) VALUES( '$username','$password' )";
        include '../model/connect.php';
        $stmt = $conn->prepare($insertuser);
        $stmt->execute();

        echo "User created, please log in";  
        header('location: ../view/php/registration_login.php');
  
    }
?>