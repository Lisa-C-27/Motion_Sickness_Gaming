<?php
session_start();
header('Content-Type: application/json');
include '../model/connect.php';
include '../model/dbfunctions.php';

//if($_GET['type'] == "fix") {
//    if($_GET['direction'] == "up") {
//        $result = updatethumbsup_fix($_GET['commID'], $_GET['userID']);
//        if($result) {
//            echo json_encode(Array('update'=>"successfix"));
//        } else {
//            echo json_encode(Array('update'=>"fail"));
//        }
//    }
//    if($_GET['direction'] == "down") {
//        $result = updatethumbsdown_fix($_GET['commID'], $_GET['userID']);
//        if($result) {
//            echo json_encode(Array('update'=>"success"));
//        } else {
//            echo json_encode(Array('update'=>"fail"));
//        }
//    }
//}

if($_GET['type'] == "fix") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('fix', 'fixThUp', 'fixID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('fix', 'fixThDown', 'fixID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
} else if($_GET['type'] == "comment") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('gamecomm', 'gameCommThUp', 'gameCommID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('gamecomm', 'gameCommThDown', 'gameCommID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
} else if($_GET['type'] == "reply") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('gamereply', 'replyCommThUp', 'gameReplyID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('gamereply', 'replyCommThDown', 'gameReplyID', $_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
} else if($_GET['type'] == "fixcomment") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('fixcomm', 'fixCommThUp', 'fixCommID',$_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('fixcomm', 'fixCommThDown', 'fixCommID',$_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
} else if($_GET['type'] == "fixreply") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('fixreply', 'fixReplyThUp', 'fixReplyID',$_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('fixreply', 'fixReplyThDown', 'fixReplyID',$_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
} else if($_GET['type'] == "game") {
    if($_GET['direction'] == "up") {
        $result = updatethumbs('game', 'gameThUp', 'gameID', $_GET['commID'], 'null');
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['direction'] == "down") {
        $result = updatethumbs('game', 'gameThDown', 'gameID',$_GET['commID'], 'null');
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}
?>