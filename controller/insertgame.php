<?php
// This process is called from 'view/php/games.php' Add game modal as part of the form action 
session_start();
include '../model/dbfunctions.php';

    if( isset( $_POST['submit_game'] ) ) {
        $checkgame = "SELECT gameName FROM game WHERE gameName='" . $_POST['gameName'] . "';";
        include '../model/connect.php';
        $stmt = $conn->prepare($checkgame);
        $stmt->execute();
        $result = $stmt->fetch();
        
        if ($stmt->rowCount() == 0){
            $game = sanitise_input($_POST['gameName']);
            $insertgame = "INSERT INTO game (gameName) VALUES(:game)";
            include '../model/connect.php';
            $stmt = $conn->prepare($insertgame);
            $stmt->bindParam(':game', $game, PDO::PARAM_STR);
            $stmt->execute();

            $_SESSION['message'] = "Game added successfully";
            $_SESSION['gamename'] = $_POST['gameName'];
            header ('location: ../view/php/games.php');  
            
        } else {
            $_SESSION['message'] = "Add failed. Game is already in library";
            $_SESSION['gamename'] = $_POST['gameName'];
            header ('location: ../view/php/games.php?addfail=true');
        }     
    }
?>
