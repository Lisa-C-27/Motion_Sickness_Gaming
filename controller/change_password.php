<?php
    session_start();
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    $password = !empty($_POST['password'])?sanitise_input(($_POST['password'])): null;
    $newpassword2 = !empty($_POST['newpassword'])? sanitise_input(($_POST['newpassword'])): null;
    $newpassword = password_hash($newpassword2, PASSWORD_DEFAULT);
    $userID = !empty($_POST['userID'])?sanitise_input(($_POST['userID'])): null;
    $username = !empty($_POST['username'])?sanitise_input(($_POST['username'])): null;

    $check = "SELECT * FROM user WHERE userID = '" . $userID . "';";  
    $stmt = $conn->prepare($check);
    $stmt->execute();
    $result = $stmt->fetch();
   
    if (password_verify($password, $result['password'])){
        $update = "UPDATE user SET password = :password WHERE userID = :userID;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':password', $newpassword, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        
        $_SESSION['message'] = "Password updated successfully";
        header ('Location: ../view/php/useraccount.php?pw=update&username='.$username);
    } else {
        $_SESSION['message'] = "Incorrect password entered";
        header ('Location: ../view/php/useraccount.php?pw=update&username='.$username);
    }
?>