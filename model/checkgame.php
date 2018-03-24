<?php

if(isset($_POST['user_email'])) {
    $gamename=$_POST['user_email'];

    $checkgame= "SELECT gameName FROM game WHERE gameName='$gamename'";
    include 'connect.php';
    $stmt = $conn->prepare($checkgame);
    $stmt->execute();
    $result = $stmt->fetch();

    if(($result)>0) {
        echo "Game already exists, please check the game library";
    } else {
        echo "Game is not in library, please add";
    }
    exit();
}
?>