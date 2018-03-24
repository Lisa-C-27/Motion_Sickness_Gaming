<?php
//The below code is not finished yet

    include 'connect.php';

    $thumbsup = "UPDATE game SET gameThUp = gameThUp + 1 WHERE gameID ='" . $_GET['gameID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($thumbsup);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
        } else {
        return false;
        }


    $thumbsdown = "UPDATE game SET gameThDown = gameThDown + 1 WHERE gameID ='" . $_GET['gameID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($thumbsdown);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
        } else {
        return false;
        }
?>