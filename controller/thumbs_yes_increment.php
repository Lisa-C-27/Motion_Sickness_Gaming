<?php

session_start();
header('Content-Type: application/json');
include '../model/connect.php';
include '../model/dbfunctions.php';

if(isset($_GET['gameID'])) {
    $result = updatethumbsup($_GET['gameID']);
    if($result) {
        echo json_encode(Array('update'=>"succes"));
    } else {
        echo json_encode(Array('update'=>"fail"));
    }
}

?>