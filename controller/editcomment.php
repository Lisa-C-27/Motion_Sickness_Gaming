<?php
include '../model/connect.php';
include '../model/dbfunctions.php';

if($_REQUEST['action_type'] == 'editgamecomment') {
    if(!empty($_POST['editgamecomment']) && $_POST['editgamecomment'] != '<div><br></div>') {
        $edit = '<p class="authoredit">Edited by author ';
        $editdate = date("d/m/Y");
        $endedit = '</p>';
        $gamecomment = sanitise_input($_POST['editgamecomment']);
        $userID = sanitise_input($_POST['userID']);
        $gameID = sanitise_input($_POST['gameID']);
        $id = sanitise_input($_POST['gamecommID']);
        
        $update = "UPDATE gamecomm SET gameComment = CONCAT(:gamecomm, ' ' , :edit , :editdate, :endedit) WHERE userID = :userID AND gameCommID = :id ;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':edit', $edit, PDO::PARAM_STR);
        $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
        $stmt->bindParam(':endedit', $endedit, PDO::PARAM_STR);
        $stmt->bindParam(':gamecomm', $gamecomment, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');
    }
} else if($_REQUEST['action_type'] == 'editgamereply') {
    if(!empty($_POST['editgamecomment']) && $_POST['editgamecomment'] != '<div><br></div>') {
        $edit = '<p class="authoredit">Edited by author ';
        $editdate = date("d/m/Y");
        $endedit = '</p>';
        $gamecomment = sanitise_input($_POST['editgamecomment']);
        $userID = sanitise_input($_POST['userID']);
        $gameID = sanitise_input($_POST['gameID']);
        $id = sanitise_input($_POST['gameReplyID']);
        
        $update = "UPDATE gamereply SET replyComment = CONCAT(:gamecomm, ' ' , :edit , :editdate, :endedit) WHERE userID = :userID AND gameReplyID = :id ;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':edit', $edit, PDO::PARAM_STR);
        $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
        $stmt->bindParam(':endedit', $endedit, PDO::PARAM_STR);
        $stmt->bindParam(':gamecomm', $gamecomment, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        header('Location: ../view/php/individual_games.php?gameID='. $gameID . '');
    }
} else if($_REQUEST['action_type'] == 'editfix') {
    if(!empty($_POST['editgamecomment']) && $_POST['editgamecomment'] != '<div><br></div>') {
        $edit = '<p class="authoredit">Edited by author ';
        $editdate = date("d/m/Y");
        $endedit = '</p>';
        $gamecomment = sanitise_input($_POST['editgamecomment']);
        $userID = sanitise_input($_POST['userID']);
        $gameID = sanitise_input($_POST['gameID']);
        $id = sanitise_input($_POST['fixID']);
        
        $update = "UPDATE fix SET fixInfo = CONCAT(:gamecomm, ' ' , :edit , :editdate, :endedit) WHERE userID = :userID AND fixID = :id ;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':edit', $edit, PDO::PARAM_STR);
        $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
        $stmt->bindParam(':endedit', $endedit, PDO::PARAM_STR);
        $stmt->bindParam(':gamecomm', $gamecomment, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        header('Location: ../view/php/individual_games.php?gameID='. $gameID . '&fix=tab');
    }
} else if($_REQUEST['action_type'] == 'editfixcomm') {
    if(!empty($_POST['editgamecomment']) && $_POST['editgamecomment'] != '<div><br></div>') {
        $edit = '<p class="authoredit">Edited by author ';
        $editdate = date("d/m/Y");
        $endedit = '</p>';
        $gamecomment = sanitise_input($_POST['editgamecomment']);
        $userID = sanitise_input($_POST['userID']);
        $gameID = sanitise_input($_POST['gameID']);
        $id = sanitise_input($_POST['fixCommID']);
        
        $update = "UPDATE fixcomm SET fixComment = CONCAT(:gamecomm, ' ' , :edit , :editdate, :endedit) WHERE userID = :userID AND fixCommID = :id ;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':edit', $edit, PDO::PARAM_STR);
        $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
        $stmt->bindParam(':endedit', $endedit, PDO::PARAM_STR);
        $stmt->bindParam(':gamecomm', $gamecomment, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        header('Location: ../view/php/individual_games.php?gameID='. $gameID . '&fix=tab');
    }
} else if($_REQUEST['action_type'] == 'editfixreply') {
    if(!empty($_POST['editgamecomment']) && $_POST['editgamecomment'] != '<div><br></div>') {
        $edit = '<p class="authoredit">Edited by author ';
        $editdate = date("d/m/Y");
        $endedit = '</p>';
        $gamecomment = sanitise_input($_POST['editgamecomment']);
        $userID = sanitise_input($_POST['userID']);
        $gameID = sanitise_input($_POST['gameID']);
        $id = sanitise_input($_POST['fixReplyID']);
        
        $update = "UPDATE fixreply SET fixReply = CONCAT(:gamecomm, ' ' , :edit , :editdate, :endedit) WHERE userID = :userID AND fixReplyID = :id ;";
        include '../model/connect.php';
        $stmt = $conn->prepare($update);
        $stmt->bindParam(':edit', $edit, PDO::PARAM_STR);
        $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
        $stmt->bindParam(':endedit', $endedit, PDO::PARAM_STR);
        $stmt->bindParam(':gamecomm', $gamecomment, PDO::PARAM_STR);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        header('Location: ../view/php/individual_games.php?gameID='. $gameID . '&fix=tab');
    }
}