<?php
    session_start();
    header('Content-Type: application/json');
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    if($_GET['type'] == "fix") {
        $result = delete_comm('fix', 'fixID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "undofix") {
        $result = undelete_comm('fix', 'fixID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "fixcomm") {
        $result = delete_comm('fixcomm', 'fixCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "undofixcomm") {
        $result = undelete_comm('fixcomm', 'fixCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "fixreply") {
        $result = delete_comm('fixreply', 'fixReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "undofixreply") {
        $result = undelete_comm('fixreply', 'fixReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "gamecomm") {
        $result = delete_comm('gamecomm', 'gameCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "undogamecomm") {
        $result = undelete_comm('gamecomm', 'gameCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "gamereply") {
        $result = delete_comm('gamereply', 'gameReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "undogamereply") {
        $result = undelete_comm('gamereply', 'gameReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "usergamecomm") {
        $result = user_delete_comm('gamecomm', 'gameCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "usergamereply") {
        $result = user_delete_comm('gamereply', 'gameReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "userfix") {
        $result = user_delete_comm('fix', 'fixID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "userfixcomm") {
        $result = user_delete_comm('fixcomm', 'fixCommID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "userfixreply") {
        $result = user_delete_comm('fixreply', 'fixReplyID', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }