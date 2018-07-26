<?php
//This process is called from the checkuser() function within the 'view/js/script.js' file
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    $checkemail= "SELECT email FROM user WHERE email='$email'";
    include '../model/connect.php';
    $stmt = $conn->prepare($checkemail);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result > 0) {
        echo "Email already exists, please try another";
    } else {
        echo "Email is available";
    }
    exit();
}
?>