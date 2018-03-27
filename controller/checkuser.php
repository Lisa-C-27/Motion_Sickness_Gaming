<?php
//This process is called from the checkuser() function within the 'view/js/script.js' file
if(isset($_POST['user_name'])) {
    $usernameId=$_POST['user_name'];

    $checkuser= "SELECT username FROM user WHERE username='$usernameId'";
    include '../model/connect.php';
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