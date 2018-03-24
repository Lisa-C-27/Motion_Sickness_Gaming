<?php

function gamelist() {
    $selectgames = "SELECT * from game ORDER BY gameName;";
    include 'connect.php';
    $stmt = $conn->prepare($selectgames);
    $stmt->execute();
    return $staticresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_one_game($gameID) {
    $selectonegame = "SELECT * FROM game WHERE gameID='" . $_GET['gameID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($selectonegame);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>