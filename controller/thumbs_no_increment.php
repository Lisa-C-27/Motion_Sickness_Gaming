<?php
//This process is called from 'view/php/individual_games.php' thumbs down button on game motion sickness
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