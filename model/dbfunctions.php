<?php

//This function is called within view/php/games.php to generate the library list of games
function gamelist() {
    $selectgames = "SELECT * from game ORDER BY gameName;";
    include 'connect.php';
    $stmt = $conn->prepare($selectgames);
    $stmt->execute();
    return $staticresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function mostRecentGame() {
    $selectgames = "SELECT * FROM game ORDER BY gameDate DESC LIMIT 1;";
    include 'connect.php';
    $stmt = $conn->prepare($selectgames);
    $stmt->execute();
    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

function mostRecentFix() {
    $selectfix = "SELECT game.gameName, game.gameID, fixDateTime FROM fix 
    INNER JOIN game ON game.gameID = fix.gameID
    ORDER BY fixDateTime DESC LIMIT 1;";
    include 'connect.php';
    $stmt = $conn->prepare($selectfix);
    $stmt->execute();
    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

//This function is called from 'view/php/individual_games.php'
function get_one_game($gameID) {
    $selectonegame = "SELECT * FROM game WHERE gameID='" . $_GET['gameID'] . "'";
    include 'connect.php';
    $stmt = $conn->prepare($selectonegame);
    $result = $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateRep($userID) {
    $update = "UPDATE rep_calcs SET 
    gameCommRep = (SELECT SUM(IFNULL(gameCommThUp,0)-IFNULL(gameCommThDown,0)) FROM gamecomm WHERE userID ='" . $userID . "'),
    gameReplyRep = (SELECT SUM(IFNULL(replyCommThUp,0)-IFNULL(replyCommThDown,0)) FROM gamereply WHERE userID ='" . $userID . "'),
    fixReplyRep = (SELECT SUM(IFNULL(fixReplyThUp,0)-IFNULL(fixReplyThDown,0)) FROM fixreply WHERE userID ='" . $userID . "'),
    fixCommRep = (SELECT SUM(IFNULL(fixCommThUp,0)-IFNULL(fixCommThDown,0)) FROM fixcomm WHERE userID ='" . $userID . "')
    WHERE userID ='" . $userID . "';";
    include 'connect.php';
    $stmt = $conn->prepare($update);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $update2 = "UPDATE user SET commRep = 
        (SELECT SUM(fixCommRep+fixReplyRep+gameCommRep+gameReplyRep) 
        FROM rep_calcs WHERE userID ='" . $userID . "')
        WHERE userID ='" . $userID . "';";
        include 'connect.php';
        $stmt = $conn->prepare($update2);
        $stmt->execute();
        return true;
    } else {
        return false;
    }
}

function updateRepFix($userID) {
    $update = "UPDATE user SET fixRep = 
    (SELECT SUM(fixThUp-fixThDown) FROM fix WHERE userID ='" . $userID . "')
    WHERE userID = '" . $userID . "';";
    include 'connect.php';
    $stmt = $conn->prepare($update);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

////This function is called from 'view/php/individual_games.php'
//function updatethumbsup($gameid) {
//    $thumbsup = "UPDATE game SET gameThUp = gameThUp + 1 WHERE gameID ='" . $gameid . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($thumbsup);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
////This function is called from 'view/php/individual_games.php'
//function updatethumbsdown($gameid) {
//    $thumbsdown = "UPDATE game SET gameThDown = gameThDown + 1 WHERE gameID ='" . $gameid . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($thumbsdown);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        return true;
//    } else {
//        return false;
//    }
//}


function updatethumbs($table, $thumb, $idtype, $id, $userID) {
    $update = "UPDATE ".$table." SET ".$thumb." = ".$thumb." + 1 WHERE ".$idtype." ='" . $id . "'";
    include 'connect.php';
    $stmt = $conn->prepare($update);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        if($userID == 'null') {
            return true;
        } else {
        updateRep($userID);
        return true;
    }
    } else {
        return false;
    }
}

//function updatethumbsup_gamecomm($commID, $userID){
//    $update = "UPDATE gamecomm SET gameCommThUp = gameCommThUp + 1 WHERE gamecommID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsdown_gamecomm($commID, $userID){
//    $update = "UPDATE gamecomm SET gameCommThDown = gameCommThDown + 1 WHERE gamecommID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsup_gamereply($commID, $userID){
//    $update = "UPDATE gamereply SET replyCommThUp = replyCommThUp + 1 WHERE gameReplyID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsdown_gamereply($commID, $userID) {
//    $update = "UPDATE gamereply SET replyCommThDown = replyCommThDown + 1 WHERE gameReplyID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsup_fix($commID, $userID){
//    $update = "UPDATE fix SET fixThUp = fixThUp + 1 WHERE fixID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRepFix($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsdown_fix($commID, $userID) {
//    $update = "UPDATE fix SET fixThDown = fixThDown + 1 WHERE fixID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRepFix($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsup_fixcomm($commID, $userID){
//    $update = "UPDATE fixcomm SET fixCommThUp = fixCommThUp + 1 WHERE fixCommID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsdown_fixcomm($commID, $userID) {
//    $update = "UPDATE fixcomm SET fixCommThDown = fixCommThDown + 1 WHERE fixCommID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsup_fixreply($commID, $userID){
//    $update = "UPDATE fixreply SET fixReplyThUp = fixReplyThUp + 1 WHERE fixReplyID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}
//
//function updatethumbsdown_fixreply($commID, $userID) {
//    $update = "UPDATE fixreply SET fixReplyThDown = fixReplyThDown + 1 WHERE fixReplyID ='" . $commID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($update);
//    $stmt->execute();
//    if ($stmt->rowCount() > 0) {
//        updateRep($userID);
//        return true;
//    } else {
//        return false;
//    }
//}

//This function is to grab game comments and username
function getGameComments($gameid) {
    $comment = "SELECT user.username, user.avatarID, avatar.url, gameComment, gameCommDateTime, gameCommThUp, gameCommThDown, gameComm.userID, gameID, gameCommID, deleted 
    FROM gamecomm
    INNER JOIN user ON user.userID = gameComm.userID
    INNER JOIN avatar ON avatar.avatarID = user.avatarID
    WHERE gameID ='" . $gameid . "'
    ORDER BY gameCommDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function is to grab the game fixes and username
function getFixes($gameID) {
    $fix = "SELECT user.username, user.avatarID, avatar.url, fixInfo, fixDateTime, fixThUp, fixThDown, fix.userID, gameID, fixID, deleted 
    FROM fix
    INNER JOIN user ON user.userID = fix.userID
    INNER JOIN avatar ON avatar.avatarID = user.avatarID
    WHERE gameID ='" . $gameID . "'
    ORDER BY fixThUp DESC";
    include 'connect.php';
    $stmt = $conn->prepare($fix);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//This function gets game reply comments
function getGameReply($gamecommID) {
    $comment = "SELECT user.username, user.avatarID, avatar.url, gameReplyID, replyComment, replyCommDateTime, replyCommThUp, replyCommThDown, gamereply.userID, gameCommID, deleted 
    FROM gamereply
    INNER JOIN user ON user.userID = gamereply.userID
    INNER JOIN avatar ON avatar.avatarID = user.avatarID
    WHERE gamecommID ='" . $gamecommID . "'
    ORDER BY replyCommDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//This function is to grab all thumbs up and thumbs down info from the database for a particular user to calculate their Rep 
//function getThumbs($userID) {
//    $rep= "SELECT user.userID, user.username, SUM(IFNULL(a.commthumbs,0)+IFNULL(b.commthumbs,0)+IFNULL(c.commthumbs,0)+IFNULL(d.commthumbs,0)) AS 'commthumbs', 
//    IFNULL(e.fixthumbs,0) AS 'fixthumbs'
//    FROM user
//    LEFT JOIN (
//        SELECT userID, SUM(IFNULL(gameCommThUp,0)-IFNULL(gameCommThDown,0)) AS 'commthumbs'
//        FROM gamecomm
//        GROUP BY userID) a ON a.userID = user.userID
//    LEFT JOIN (
//        SELECT userID, SUM(IFNULL(fixCommThUp,0)-IFNULL(fixCommThDown,0)) AS 'commthumbs'
//        FROM fixcomm
//        GROUP BY userID) b ON b.userID = user.userID
//    LEFT JOIN (
//        SELECT userID, SUM(IFNULL(replyCommThUp,0)-IFNULL(replyCommThDown,0)) AS 'commthumbs'
//        FROM gamereply
//        GROUP BY userID) c ON c.userID = user.userID  
//    LEFT JOIN (
//        SELECT userID, SUM(IFNULL(fixReplyThUp,0)-IFNULL(fixReplyThDown,0)) AS 'commthumbs'
//        FROM fixreply
//        GROUP BY userID) d ON d.userID = user.userID    
//    LEFT JOIN (
//        SELECT userID, SUM(IFNULL(fixThUp,0)-IFNULL(fixThDown,0)) AS 'fixthumbs'
//        FROM fix
//        GROUP BY userID) e ON e.userID = user.userID
//    WHERE user.userID ='" . $userID . "'";
//    include 'connect.php';
//    $stmt = $conn->prepare($rep);
//    $result = $stmt->execute();
//    return $stmt->fetch(PDO::FETCH_ASSOC);
//}

function getThumbs($userID) {
    $rep = "SELECT commRep, fixRep FROM user WHERE userID ='" . $userID . "'";
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
    $comment = "SELECT user.username, user.avatarID, avatar.url, fixCommID, fixComment, fixCommDateTime, fixCommThUp, fixCommThDown, fixcomm.userID, fixID, deleted 
    FROM fixcomm
    INNER JOIN user ON user.userID = fixcomm.userID
    INNER JOIN avatar ON avatar.avatarID = user.avatarID
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
    $comment = "SELECT user.username, user.avatarID, avatar.url, fixReplyID, fixReply, fixReplyDateTime, fixReplyThUp, fixReplyThDown, fixreply.userID, fixcommID, deleted 
    FROM fixreply
    INNER JOIN user ON user.userID = fixreply.userID
    INNER JOIN avatar ON avatar.avatarID = user.avatarID
    WHERE fixCommID ='" . $fixCommID . "'
    ORDER BY fixReplyDateTime DESC";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUsers() {
    $users = "SELECT count(*) as 'users' FROM user;";
    include 'connect.php';
    $stmt = $conn->prepare($users);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getGames() {
    $game = "SELECT count(*) as 'games' FROM game;";
    include 'connect.php';
    $stmt = $conn->prepare($game);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

function getFixesNo() {
    $fix = "SELECT count(*) as 'fixes' FROM fix;";
    include 'connect.php';
    $stmt = $conn->prepare($fix);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

function getComments() {
    $fix = "SELECT 
        (select count(*) from fixcomm)
        +
        (select count(*) from gamecomm)
        AS 'comms';";
    include 'connect.php';
    $stmt = $conn->prepare($fix);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

function getReplies() {
    $replies = "SELECT (select count(*) from fixreply)+(select count(*) from gamereply)
    AS 'replies';";
    include 'connect.php';
    $stmt = $conn->prepare($replies);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);  
}

function getAllUsers() {
    $users = "SELECT * FROM user ORDER BY username;";
    include 'connect.php';
    $stmt = $conn->prepare($users);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

function getOneUser($userID) {
    $user = "SELECT user.userID, user.username, avatar.avatarID, avatar.url, user.acctStatus 
    FROM user
    INNER JOIN avatar ON avatar.avatarID = user.avatarID 
    WHERE user.userID ='" . $userID . "';";
    include 'connect.php';
    $stmt = $conn->prepare($user);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

function getImages() {
    $image = "SELECT * FROM avatar;";
    include 'connect.php';
    $stmt = $conn->prepare($image);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//function getAllUserFix($userID) {
//    $fix = "SELECT * FROM fix
//    WHERE userID = '" . $userID . "';";
//    include 'connect.php';
//    $stmt = $conn->prepare($fix);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
//function getAllUserFixComm($userID) {
//    $fixcomm = "SELECT * FROM fixcomm
//    WHERE userID = '" . $userID . "';";
//    include 'connect.php';
//    $stmt = $conn->prepare($fixcomm);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
//function getAllUserFixReply($userID) {
//    $fixreply = "SELECT * FROM fixreply
//    WHERE userID = '" . $userID . "';";
//    include 'connect.php';
//    $stmt = $conn->prepare($fixreply);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
//function getAllUserGameComm($userID) {
//    $gamecomm = "SELECT * FROM gamecomm
//    WHERE userID = '" . $userID . "';";
//    include 'connect.php';
//    $stmt = $conn->prepare($gamecomm);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}
//function getAllUserGameReply($userID) {
//    $gamereply = "SELECT * FROM gamereply
//    WHERE userID = '" . $userID . "';";
//    include 'connect.php';
//    $stmt = $conn->prepare($gamereply);
//    $stmt->execute();
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//}

function getAllUserComments($table, $userID) {
    $comment = "SELECT * FROM ".$table."
    WHERE userID = '" . $userID . "';";
    include 'connect.php';
    $stmt = $conn->prepare($comment);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function delete_comm($table, $column, $id) {
    $delete = "UPDATE ".$table." SET deleted = true WHERE ".$column." = '" . $id . "';";
    include 'connect.php';
    $stmt = $conn->prepare($delete);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
function undelete_comm($table, $column, $id) {
    $undelete = "UPDATE ".$table." SET deleted = false WHERE ".$column." = '" . $id . "';";
    include 'connect.php';
    $stmt = $conn->prepare($undelete);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function change_status($type, $userID) {
    $status = "UPDATE user SET acctStatus = ".$type." WHERE userID = '" . $userID . "';";
    include 'connect.php';
    $stmt = $conn->prepare($status);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
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
