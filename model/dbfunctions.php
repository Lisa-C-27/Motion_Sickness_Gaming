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
    WHERE gameID ='" . $gameid . "'
    ORDER BY gameCommDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function is to grab the game fixes and username
function getFixes($gameID) {
    $fix = "SELECT user.username, fixInfo, fixDateTime, fixThUp, fixThDown, fix.userID, gameID, fixID 
    FROM fix
    INNER JOIN user ON user.userID = fix.userID
    WHERE gameID ='" . $gameID . "'
    ORDER BY fixThUp DESC";
    include 'connect.php';
    $stmt = $conn->prepare($fix);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function gets game reply comments
function getGameReply($gamecommID) {
    $comment = "SELECT user.username, gameReplyID, replyComment, replyCommDateTime, replyCommThUp, replyCommThDown, gamereply.userID, gameCommID 
    FROM gamereply
    INNER JOIN user ON user.userID = gamereply.userID
    WHERE gamecommID ='" . $gamecommID . "'
    ORDER BY replyCommDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//This function is to grab all thumbs up and thumbs down info from the database for a particular user to calculate their Rep 
function getThumbs($userID) {
    $rep= "SELECT user.userID, user.username, SUM(IFNULL(a.commthumbs,0)+IFNULL(b.commthumbs,0)+IFNULL(c.commthumbs,0)+IFNULL(d.commthumbs,0)) AS 'commthumbs', 
    IFNULL(e.fixthumbs,0) AS 'fixthumbs'
    FROM user
    LEFT JOIN (
        SELECT userID, SUM(IFNULL(gameCommThUp,0)-IFNULL(gameCommThDown,0)) AS 'commthumbs'
        FROM gamecomm
        GROUP BY userID) a ON a.userID = user.userID
    LEFT JOIN (
        SELECT userID, SUM(IFNULL(fixCommThUp,0)-IFNULL(fixCommThDown,0)) AS 'commthumbs'
        FROM fixcomm
        GROUP BY userID) b ON b.userID = user.userID
    LEFT JOIN (
        SELECT userID, SUM(IFNULL(replyCommThUp,0)-IFNULL(replyCommThDown,0)) AS 'commthumbs'
        FROM gamereply
        GROUP BY userID) c ON c.userID = user.userID  
    LEFT JOIN (
        SELECT userID, SUM(IFNULL(fixReplyThUp,0)-IFNULL(fixReplyThDown,0)) AS 'commthumbs'
        FROM fixreply
        GROUP BY userID) d ON d.userID = user.userID    
    LEFT JOIN (
        SELECT userID, SUM(IFNULL(fixThUp,0)-IFNULL(fixThDown,0)) AS 'fixthumbs'
        FROM fix
        GROUP BY userID) e ON e.userID = user.userID
    WHERE user.userID ='" . $userID . "'";
    include 'connect.php';
    $stmt = $conn->prepare($rep);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//This function is generic for inserting comments and replies
function insertComment($table, $data){
    include 'connect.php';
    if(!empty($data) && is_array($data)){
        $columns = '';
        $values  = '';
        $columnString = implode(',', array_keys($data));
        $valueString = ":".implode(',:', array_keys($data));
        $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
        $query = $conn->prepare($sql);
        print_r($data);
        foreach($data as $key=>$val){
            $query->bindValue(':'.$key, $val);
        }
        $insert = $query->execute();
    }
    return $insert;
}

//This function gets the number of replies
function getReplyNumber($commID){
    $reply = "SELECT COUNT(*) as 'replies', gameCommID 
    FROM gamereply
    WHERE gameCommID = '" . $commID . "'";
    include 'connect.php';
    $stmt = $conn->prepare($reply);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//This function gets the number of fix comments
function getFixCommentNumber($fixID) {
    $reply = "SELECT COUNT(*) as 'replies', fixID 
    FROM fixcomm
    WHERE fixID = '" . $fixID . "'";
    include 'connect.php';
    $stmt = $conn->prepare($reply);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getFixComments($fixID) {
    $comment = "SELECT user.username, fixCommID, fixComment, fixCommDateTime, fixCommThUp, fixCommThDown, fixcomm.userID, fixID 
    FROM fixcomm
    INNER JOIN user ON user.userID = fixcomm.userID
    WHERE fixID ='" . $fixID . "'
    ORDER BY fixCommDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFixCommReplyNumber($fixCommID) {
    $reply = "SELECT COUNT(*) as 'replies', fixcommID 
    FROM fixreply
    WHERE fixcommID = '" . $fixCommID . "'";
    include 'connect.php';
    $stmt = $conn->prepare($reply);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getFixReplies($fixCommID) {
    $comment = "SELECT user.username, fixReplyID, fixReply, fixReplyDateTime, fixReplyThUp, fixReplyThDown, fixreply.userID, fixcommID 
    FROM fixreply
    INNER JOIN user ON user.userID = fixreply.userID
    WHERE fixCommID ='" . $fixCommID . "'
    ORDER BY fixReplyDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function sanitises input
function sanitise_input($input_string) {
    include 'connect.php';
    $input_string = trim($input_string);
    $input_string = stripslashes($input_string);
    $input_string = htmlspecialchars($input_string);
    $input_string = strip_tags($input_string);
    return $input_string;
}

?>
