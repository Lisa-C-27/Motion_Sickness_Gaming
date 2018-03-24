<?php

    if( isset( $_POST['submit_game'] ) ) {

        $game = $_POST['gameName'];

        $insertgame = "INSERT INTO game (gameName) VALUES( '$game' )";
        include 'connect.php';
        $stmt = $conn->prepare($insertgame);
        $stmt->execute();

        header ('location: ../view/php/games.php');
    }
?>