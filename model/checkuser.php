<?php

if(isset($_POST['user_email'])) {
    $usernameId=$_POST['user_email'];

    $checkuser= "SELECT username FROM user WHERE username='$usernameId'";
    include 'connect.php';
    $stmt = $conn->prepare($checkuser);
    $stmt->execute();
    $result = $stmt->fetch();

    if(($result)>0) {
        echo "Username already exists, please try another";
    } else {
        echo "Username is available";
    }
    exit();
}
?>