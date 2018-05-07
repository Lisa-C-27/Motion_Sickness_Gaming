<?php
//This process is called from 'view/php/login.php' login form
    session_start();
    include '../model/connect.php';
    include '../model/dbfunctions.php';
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(!empty($_POST["remember"])) {
        setcookie ("username",$_POST["username"],time()+ 3600);
        setcookie ("password",$_POST["password"],time()+ 3600);
//	echo "Cookies Set Successfuly";
    } else {
        setcookie("username","");
        setcookie("password","");
//	echo "Cookies Not Set";
    }
    
    $username = !empty($_POST['username'])? sanitise_input(($_POST['username'])): null;
    $password = !empty($_POST['password'])? sanitise_input(($_POST['password'])): null;
try{
    $login_sql = "SELECT * FROM user WHERE username = '" . $username . "';";
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();
    
    if (password_verify($password, $result['password'])){

            //This sets session as admin. Admin will be able to delete comments
            if ($result['acctStatus'] == '3') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $result['username'];
                $_SESSION['userid'] = $result['userID'];
                $_SESSION['account'] = "admin";
                header('location: ../view/php/admin.php');

            //This sets session as active. Active/registered users can add games/fixes/comments
            } else if ($result['acctStatus'] == '1') {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $result['username'];
                $_SESSION['userid'] = $result['userID'];
                $_SESSION['account'] = "active";
                header('location: ../view/php/index.php');

            //If a disabled account tries to login it will display that the account is disabled
            } else if ($result['acctStatus'] == '2') {
               $_SESSION['message'] = "Login Error: Account has been disabled";
                header('location: ../view/php/login.php');
            }
     
    }  else {
        $_SESSION['message'] = "Login Error: Incorrect username or password";
        header("location: ../view/php/login.php");     
    } 
}catch(PDOException $e) {
      echo "Login Error".$e -> getMessage();
      die();
}
}
?>
