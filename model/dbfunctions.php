<?php
//This function is called within view/php/games.php to generate the library list of games
function gamelist() {
    $selectgames = "SELECT * from game ORDER BY gameName;";
    include 'connect.php';
    $stmt = $conn->prepare($selectgames);
    $stmt->execute();
    return $staticresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function is called from 'view/php/individual_games.php'
function get_one_game($gameID) {
    $selectonegame = "SELECT * FROM game WHERE gameID='" . $_GET['gameID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($selectonegame);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//This function is called from 'view/php/individual_games.php'
function updatethumbsup($gameid) {
    $thumbsup = "UPDATE game SET gameThUp = gameThUp + 1 WHERE gameID ='" . $gameid . "'";
    include 'connect.php';
    $stmt = $conn->prepare($thumbsup);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

//This function is called from 'view/php/individual_games.php'
function updatethumbsdown($gameid) {
    $thumbsdown = "UPDATE game SET gameThDown = gameThDown + 1 WHERE gameID ='" . $gameid . "'";
    include 'connect.php';
    $stmt = $conn->prepare($thumbsdown);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
?>
