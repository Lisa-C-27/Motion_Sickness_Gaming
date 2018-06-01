<div class="gamevote">
    <p>Does this game give you motion sickness?</p>
    <?php    
    if(isset($_SESSION['userid'])) {
        $getThRec = getuserThumbRecords($_SESSION['userid'], 'gameID', $_GET['gameID']);
    }
    ?>
        <span class="gamevoting" <?php if(isset($_SESSION['userid']) && empty($getThRec)) { ?>onclick="updatethumb('game', 'up', <?php echo $_GET['gameID']; ?>, 'null');"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>title="<?php echo $gamedetails['gameThUp']; ?> community members voted that <?php echo $gamedetails['gameName'] ?> gave them motion sickness" id="disableup">
            <button type="button" class="pure-button thumbs">
                YES 
                <i class="fas fa-check-circle"></i>
            </button>
            <input type="number" class="game" disabled value="<?php echo $gamedetails['gameThUp']; ?>" id="gameup_<?php echo $gamedetails['gameID']; ?>"/>
        </span>
        <span class="gamevoting" <?php if(isset($_SESSION['userid']) && empty($getThRec)) { ?> onclick="updatethumb('game','down', <?php echo $_GET['gameID']; ?>, 'null');"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> title="<?php echo $gamedetails['gameThDown']; ?> community members voted that <?php echo $gamedetails['gameName'] ?> did not give them motion sickness" id="disabledown">
            <button type="button" class="pure-button thumbs">
                NO 
                <i class="fas fa-times-circle"></i>
            </button>
            <input type="number" class="game" disabled value="<?php echo $gamedetails['gameThDown'] ?>" id="gamedown_<?php echo $gamedetails['gameID']; ?>"/>
        </span>
        <?php if(!empty($getThRec) && $getThRec['thumbType'] == "up") { ?>
        <p>You voted yes</p>
        <?php
            } else if(!empty($getThRec) && $getThRec['thumbType'] == "down") { ?>
        <p>You voted no</p>
        <?php
            }
        ?>
</div>
