<?php
include '../model/connect.php';
include '../model/dbfunctions.php';
//header('Content-Type: application/json');

if($_REQUEST['action_type'] == 'addgamecomment') {
    if(!empty($_POST['gamecomment']) && $_POST['gamecomment'] != '<div><br></div>') {
        if($_POST['type'] == 'comment') {
            $gamecomment = sanitise_input($_POST['gamecomment']);
            $userID = sanitise_input($_POST['userID']);
            $gameID = sanitise_input($_POST['gameID']);
            $data = //set the variable $data within the insertData($table,$data) function to the following array
                array(
                    'gameComment' => $gamecomment,
                    'userID' => $userID,
                    'gameID'=> $gameID
                );
            $table="gamecomm"; //table name in DB to insert data into
            //function call from db_functions.php
            insertComment($table,$data);
            header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');
        } else if ($_POST['type'] == 'fix') {
            $gamecomment = sanitise_input($_POST['gamecomment']);
            $userID = sanitise_input($_POST['userID']);
            $gameID = sanitise_input($_POST['gameID']);
            $data = //set the variable $data within the insertData($table,$data) function to the following array
                array(
                    'fixInfo' => $gamecomment,
                    'userID' => $userID,
                    'gameID'=> $gameID
                );
            $table="fix"; //table name in DB to insert data into
            //function call from db_functions.php
            insertComment($table,$data);
            header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');
        }
} else if(empty($_POST['gamecomment']) || $_POST['gamecomment'] === '<div><br></div>'){
    $_SESSION['message'] = 'Please enter a comment';
    header('Location: ../view/php/individual_games.php?gameID='. $_POST['gameID'] . '');
}
}
if($_REQUEST['action_type'] == 'addgamereplycomment') {
    if(!empty($_POST['replygamecomment'])){
    $gamecomment = sanitise_input($_POST['replygamecomment']);
    $userID = sanitise_input($_POST['userID']);
    $gamecommID = sanitise_input($_POST['gamecommID']);
    $gameID = sanitise_input($_POST['gameID']);
    $data = //set the variable $data within the insertData($table,$data) function to the following array
        array(
            'replyComment' => $gamecomment,
            'userID' => $userID,
            'gameCommID'=> $gamecommID
        );
    $table="gamereply"; //table name in DB to insert data into
    //function call from db_functions.php
    insertComment($table,$data);
    header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');
} else {
    $_SESSION['message'] = "Please enter a comment";
    header('Location: ../view/php/individual_games.php?gameID='. $_POST['gameID'] . '');
}
}
if($_REQUEST['action_type'] == 'addfixreplycomment') {
    if(!empty($_POST['fixreplycomment'])){
    $fixcomment = sanitise_input($_POST['fixreplycomment']);
    $userID = sanitise_input($_POST['userID']);
    $fixcommID = sanitise_input($_POST['fixcommID']);
    $gameID = sanitise_input($_POST['gameID']);
    $data = //set the variable $data within the insertData($table,$data) function to the following array
        array(
            'fixReply' => $fixcomment,
            'userID' => $userID,
            'fixcommID'=> $fixcommID
        );
    $table="fixreply"; //table name in DB to insert data into
    //function call from db_functions.php
    insertComment($table,$data);
    header('Location: ../view/php/individual_games.php?gameID='. $gameID . '&fix=tab');
} else {
    $_SESSION['message'] = "Please enter a comment";
    header('Location: ../view/php/individual_games.php?gameID='. $_POST['gameID'] . '&fix=tab');
}
}
if($_REQUEST['action_type'] == 'addfixcomment') { if(!empty($_POST['fixcomment'])){
    $fixcomment = sanitise_input($_POST['fixcomment']);
    $userID = sanitise_input($_POST['userID']);
    $fixID = sanitise_input($_POST['fixID']);
    $gameID = sanitise_input($_POST['gameID']);
    $data = //set the variable $data within the insertData($table,$data) function to the following array
        array(
            'fixComment' => $fixcomment,
            'userID' => $userID,
            'fixID'=> $fixID
        );
    $table="fixcomm"; //table name in DB to insert data into
    //function call from db_functions.php
    insertComment($table,$data);
    header('Location: ../view/php/individual_games.php?gameID='. $gameID . '&fix=tab');
} else {
    $_SESSION['message'] = "Please enter a comment";
    header('Location: ../view/php/individual_games.php?gameID='. $_POST['gameID'] . '&fix=tab');
}
}
?>