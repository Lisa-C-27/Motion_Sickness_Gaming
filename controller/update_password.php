<?php
//Need to hash the password before database insertion
    session_start();
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    if(isset($_POST['pwreset'])) {
        $password1 = !empty($_POST['password'])?sanitise_input(($_POST['password'])): null;
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $userID = !empty($_POST['userID'])?sanitise_input(($_POST['userID'])): null;
        
        $update = "UPDATE user SET password = :password WHERE userID = :userID;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            $updatehash =  "UPDATE password_recovery SET expired = true WHERE userID = :userID;";
            include '../model/connect.php';
            $stmt = $conn->prepare($updatehash);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            $_SESSION['message'] = "Password updated";
            header ('Location: ../view/php/redirect.php');
        }else {
            $_SESSION['message'] = "Error updating password";
            header ('Location: ../view/php/redirect.php');
        }
    }
?>