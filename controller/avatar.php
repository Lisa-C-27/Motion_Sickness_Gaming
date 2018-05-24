<?php
    session_start();

    $avatar = "UPDATE user SET avatarID ='" . $_POST['avatarID'] . "' WHERE userID ='" . $_POST['userID'] . "'";
    include '../model/connect.php';
    $stmt = $conn->prepare($avatar);
    $stmt->execute();
    header ('Location: ../view/php/useraccount.php?username='.$_POST['username']);

?>