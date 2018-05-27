<?php
    session_start();
    header('Content-Type: application/json');
    include '../model/connect.php';
    include '../model/dbfunctions.php';

    if($_GET['type'] == "disable") {
        $result = change_status('2', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "active") {
        $result = change_status('1', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    } else if($_GET['type'] == "admin") {
        $result = change_status('3', $_GET['id']);
        if($result) {
            echo json_encode(Array('update'=>"success"));
        } else {
            echo json_encode(Array('update'=>"fail"));
        }
    }
        
?>