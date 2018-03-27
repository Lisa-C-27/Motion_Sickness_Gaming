<?php

session_start();

    if( isset( $_POST['submit_game'] ) ) {
 
        $checkgame = "SELECT gameName FROM game WHERE gameName='" . $_POST['gameName'] . "';";
        include '../model/connect.php';
        $stmt = $conn->prepare($checkgame);
        $stmt->execute();
        $result = $stmt->fetch();
        
        if ($stmt->rowCount() == 0){
            $game = $_POST['gameName'];
            $insertgame = "INSERT INTO game (gameName) VALUES( '$game' )";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertgame);
            $stmt->execute();

            $_SESSION['message'] = "Game added successfully";
            header ('location: ../view/php/games.php');  
            
        } else {
            $_SESSION['message'] = "Add failed. Game is already in library"; 
            header ('location: ../view/php/games.php');
        }     
    }
?>
