<?php

    $commentID = $_GET['gamecommID'];
    $gameID = $_GET['gameID'];
    $userID = $_GET['userID'];

    $delete = "DELETE FROM gameComm WHERE gameCommID='$commentID' AND userID ='$userID'";
    include '../model/connect.php';
    $stmt = $conn->prepare($delete);
    $result = $stmt->execute();
//    return $result;
    
    header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');

?>