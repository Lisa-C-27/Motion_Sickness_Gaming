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

//This function is to grab game comments and username
function getGameComments($gameid) {
    $comment = "SELECT user.username, gameComment, gameCommDateTime, gameCommThUp, gameCommThDown, gameComm.userID, gameID, gameCommID 
    FROM gamecomm
    INNER JOIN user ON user.userID = gameComm.userID
    WHERE gameID ='" . $gameid . "'";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function gets game reply comments
function getGameReply($gamecommID) {
    $comment = "SELECT user.username, replyComment, replyCommDateTime, replyCommThUp, replyCommThDown, gamereply.userID, gameCommID 
    FROM gamereply
    INNER JOIN user ON user.userID = gamereply.userID
    WHERE gamecommID ='" . $gamecommID . "'";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//This function is to grab all thumbs up and thumbs down info from the database for a particular user to calculate their Rep 
function getThumbs($userID) {
    $rep = "SELECT user.userID, user.username,
    SUM(a.commthumbs+b.commthumbs) AS 'commthumbs', 
    c.fixthumbs AS 'fixthumbs'
    FROM user
    LEFT JOIN (
        SELECT userID, SUM(gameCommThUp-gameCommThDown) AS 'commthumbs'
        FROM gamecomm
        GROUP BY userID) a ON a.userID = user.userID
    LEFT JOIN (
        SELECT userID, SUM(fixCommThUp-fixCommThDown) AS 'commthumbs'
        FROM fixcomm
        GROUP BY userID) b ON b.userID = user.userID
    LEFT JOIN (
        SELECT userID, SUM(fixThUp-fixThDown) AS 'fixthumbs'
        FROM fix
        GROUP BY userID) c ON c.userID = user.userID
    WHERE user.userID ='" . $userID . "'" ;
    include 'connect.php';
    $stmt = $conn->prepare($rep);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);;
}

//Below function works - keep just in case
//function getThumbs($userID) {
//    $rep = "SELECT user.userID, 
//    sum(a.thumbsup) AS 'commthumbsUp', 
//    sum(a.thumbsDown) AS 'commThDown', 
//    sum(b.thumbsup) as 'fixCommThUp', 
//    sum(b.thumbsdown) AS 'fixCommThDown', 
//    sum(c.thumbsup) AS 'fixThUp', 
//    sum(c.thumbsdown) AS 'fixThDown'
//    FROM user
//    LEFT JOIN (
//        SELECT userID, SUM(gameCommThUp) AS 'thumbsup', SUM(gameCommThDown) AS 'thumbsdown'
//        FROM gamecomm
//        GROUP BY userID) a ON a.userID = user.userID
//    LEFT JOIN (
//        SELECT userID, SUM(fixCommThUp) AS 'thumbsup', 
//        SUM(fixCommThDown) AS 'thumbsdown'
//        FROM fixcomm
//        GROUP BY userID) b ON b.userID = user.userID
//    LEFT JOIN (
//        SELECT userID, SUM(fixThUp) AS 'thumbsup', 
//        SUM(fixThDown) AS 'thumbsdown'
//        FROM fix
//        GROUP BY userID) c ON c.userID = user.userID
//    WHERE user.userID ='" . $userID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($rep);
//    $stmt->execute();
//    return $staticresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
?>
