<?php
//The below code is not finished yet
session_start();
header('Content-Type: application/json');
include '../model/connect.php';
include '../model/dbfunctions.php';


if(isset($_GET['gameID'])) {
    $result = updatethumbsdown($_GET['gameID']);
    if($result) {
        echo json_encode(Array('update'=>"success"));
    } else {
        echo json_encode(Array('update'=>"fail"));
    }
}