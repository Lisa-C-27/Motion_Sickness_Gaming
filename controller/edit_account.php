<?php
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    $username1 = $_SESSION['username'];

    if($_REQUEST['action_type'] == 'edit_username') { 
        if($_REQUEST['submit_type'] == 'submit') {
            $userID = !empty($_POST['userID'])?sanitise_input(($_POST['userID'])): null;
            $username = !empty($_POST['username'])?sanitise_input(($_POST['username'])): null;
            
            $usernameCheck = "SELECT username FROM user WHERE username = '" . $_POST['username'] . "';";
            include '../model/connect.php';
            $stmt = $conn->prepare($usernameCheck);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($stmt->rowCount() == 0){     
                $update = "UPDATE user SET username = :username WHERE userID = :userID;";
                include '../model/connect.php';
                $stmt = $conn->prepare($update);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
                $stmt->execute();

                header ('Location: ../view/php/useraccount.php?username='.$username);
            } else {
                header ('Location: ../view/php/useraccount.php?username='.$username1);
            }
        } else if($_REQUEST['submit_type'] == 'cancel') {
            header ('Location: ../view/php/useraccount.php?username='. $_SESSION['username']);
        }
    }
    if($_REQUEST['action_type'] == 'edit_email') {
        if($_REQUEST['submit_type'] == 'submit') {
            $userID = !empty($_POST['userID'])?sanitise_input(($_POST['userID'])): null;
            $email = !empty($_POST['email'])?sanitise_input(($_POST['email'])): null;
            
            $emailCheck = "SELECT email FROM user WHERE email = '" . $_POST['email'] . "';";
            include '../model/connect.php';
            $stmt = $conn->prepare($emailCheck);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($stmt->rowCount() == 0){     
                $update = "UPDATE user SET email = :email WHERE userID = :userID;";
                include '../model/connect.php';
                $stmt = $conn->prepare($update);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
                $stmt->execute();

                header ('Location: ../view/php/useraccount.php?username='.$username1);
            } else {           
                header ('Location: ../view/php/useraccount.php?username='.$username1);
            }
        } else if($_REQUEST['submit_type'] == 'cancel') {
            header ('Location: ../view/php/useraccount.php?username='. $_SESSION['username']);
        }
    }

?>