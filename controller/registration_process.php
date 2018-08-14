<?php
//This process is called from 'view/php/register.php' registration form
    session_start();
    include '../model/dbfunctions.php';

    if( isset( $_POST['registration_form'] ) ) {
        
    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' OR email = '" . $_POST['email'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

        if ($stmt->rowCount() == 0){

            $username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null;
            $email = !empty($_POST['email'])? sanitise_input(($_POST['email'])): null;
            $password2 = !empty($_POST['userpass'])? sanitise_input(($_POST['userpass'])): null;
            $password = password_hash($password2, PASSWORD_DEFAULT);
            
            if ($username === null || $password2 === null || $email === null) {
                $_SESSION['message'] = "Username, email and password cannot be blank";   
                header('Location: ../view/php/register.php');
            } else if (empty($_POST['agree'])) {
                $_SESSION['message'] = "Please indicate that you have read and agree to the Terms and Conditions";   
                header('Location: ../view/php/register.php?username='. $username .'&email='. $email); 
            }
            else {

            $insertuser = "INSERT INTO user (username, email, password, acctStatus, avatarID) VALUES (:username, :email, :password, '1', '1')";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertuser);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $userID = $conn->lastInsertID();
            
            $insertrep = "INSERT INTO rep_calcs (userID) VALUES (:userID)";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertrep);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userid'] = $userID;
            $_SESSION['account'] = 'active';
            if(!empty($_POST['gameID'])) {
                $gameID = $_POST['gameID'];
                header('location: ../view/php/individual_games.php?gameID='.$gameID);
            } if(!empty($_POST['blogID'])) {
                    $blogID = $_POST['blogID'];
                    header('location: ../view/php/blog.php?blogID='.$blogID);
            } else {
                header('location: ../view/php/index.php');
            }
        }
        }else {
            $_SESSION['message'] = "Username or email already exists";   
            header('Location: ../view/php/register.php');        
        }     
    }
?>

