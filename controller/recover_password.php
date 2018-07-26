<?php
    include '../../model/dbfunctions.php';
    
    $gettime = "SELECT * FROM password_recovery WHERE hashlink ='" . $hashed . "';";
    include '../../model/connect.php';
    $stmt = $conn->prepare($gettime);
    $stmt->execute();
    $result = $stmt->fetch();

    $userID = $result['userID'];
    $date = $result['time'];
    $expired = $result['expired'];
?>