<?php
// This process is called from 'view/php/individual_games.php' Add fix modal as part of the form action 
session_start();
include '../model/dbfunctions.php';

    if( isset( $_POST['submit_fix'] ) ) {
        $fix = sanitise_input($_POST['fix']);
        $gameID = sanitise_input($_POST['gameID']);
        $userID = sanitise_input($_POST['userID']);

        $insertfix = "INSERT INTO fix (fixInfo, fixThUp, fixThDown, userID, gameID) VALUES(:fix, '0', '0', :userID, :gameID)";
        include '../model/connect.php';
        $stmt = $conn->prepare($insertfix);
        $stmt->bindParam(':fix', $fix, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':gameID', $gameID, PDO::PARAM_INT);
        $stmt->execute();

        header ('location: ../view/php/individual_games.php?gameID='.$gameID.'&fix=tab');             
    } else {
        $_SESSION['message'] = "Error adding fix. Please try again";
        header ('location: ../view/php/individual_games.php?gameID='.$gameID.'');
    } 

?>