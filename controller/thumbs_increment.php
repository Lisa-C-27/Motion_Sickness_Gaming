<?php
session_start();
header('Content-Type: application/json');
include '../model/connect.php';
include '../model/dbfunctions.php';

if($_GET['type'] == "fix") {
    if($_GET['direction'] == "up") {
        $result = updatethumbsup_fix($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"successfix"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
    if($_GET['direction'] == "down") {
        $result = updatethumbsdown_fix($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}

else if($_GET['type'] == "comment") {
    if($_GET['direction'] == "up") {
        $result = updatethumbsup_gamecomm($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"successcomm"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
    if($_GET['direction'] == "down") {
        $result = updatethumbsdown_gamecomm($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}

else if($_GET['type'] == "reply") {
    if($_GET['direction'] == "up") {
        $result = updatethumbsup_gamereply($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"successreply"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
    if($_GET['direction'] == "down") {
        $result = updatethumbsdown_gamereply($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}

else if($_GET['type'] == "fixcomment") {
    if($_GET['direction'] == "up") {
        $result = updatethumbsup_fixcomm($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
    if($_GET['direction'] == "down") {
        $result = updatethumbsdown_fixcomm($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}

else if($_GET['type'] == "fixreply") {
    if($_GET['direction'] == "up") {
        $result = updatethumbsup_fixreply($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
    if($_GET['direction'] == "down") {
        $result = updatethumbsdown_fixreply($_GET['commID'], $_GET['userID']);
        if($result) {
            echo json_encode(Array('update'=>"succes"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
}
?>