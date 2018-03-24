<?php
    session_start();
?>
<?php

    $login_sql = "SELECT * FROM user WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";
    include '../model/connect.php';
    $stmt = $conn->prepare($login_sql);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($stmt->rowCount() == 0){
        $_SESSION['error'] = "Incorrect username or password";
        header("location: ../view/php/login.php");
    } else {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $result['username'];
        $_SESSION['userid'] = $result['user_ID'];
        header('location: ../view/php/index.php');
    }
?>
