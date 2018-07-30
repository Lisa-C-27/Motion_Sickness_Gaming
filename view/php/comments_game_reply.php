<!-- //Reply section is hidden until the 'View x replies' link is clicked       -->
<div class="replies" id="replyview_<?php echo $row['gameCommID'] ?>">
    <?php
        foreach($getreply as $row2) {
            if($row2['user_deleted'] == true) {
            
            } else {
    ?>
    <div class="comment-top">
        <div class="userinfo">     
            <span class="username"><?php echo $row2['username'] ?></span>
    <!--    //Checking comment reputation and adding a rep name based on the rep number-->
            <span class="commrep">
                <?php
                    $getrep = getThumbs($row2['userID']);
                    include 'rep_comments.php';
                ?>
            </span>
            <span class="date">
                <?php
                    $phpdate = strtotime( $row2['replyCommDateTime'] );
                    $mysqldate = date( 'd-M-Y g:i A', $phpdate );
                    echo $mysqldate
                ?>
            </span>
        </div>
        <div class="vote">
            <span class="small">   
                <?php 
                    if(isset($_SESSION['userid'])) {
                        $getThRec2 = getuserThumbRecords($_SESSION['userid'], 'gameReplyID', $row2['gameReplyID']);
                    }
                    if(!empty($getThRec2) && $getThRec2['thumbType'] == "up") { 
                        echo 'You liked this';
                    } else if(!empty($getThRec2) && $getThRec2['thumbType'] == "down") { 
                        echo 'You disliked this';
                    }
                ?>
            </span>
            <span class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec2)) { ?> onclick="updatethumb('gamereply', 'up', <?php echo $row2['gameReplyID'] ?>, <?php echo $row2['userID'] ?>)"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide3_<?php echo $row2['gameReplyID'] ?>">
                <i class="fas fa-thumbs-up"></i>
                <input type="number" disabled value="<?php echo $row2['replyCommThUp'] ?>" id="replyup_<?php echo $row2['gameReplyID'] ?>"/>
            </span>
            <span class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec2)) { ?> onclick="updatethumb('gamereply', 'down', <?php echo $row2['gameReplyID'] ?>, <?php echo $row2['userID'] ?>)"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide4_<?php echo $row2['gameReplyID'] ?>">
                <i class="fas fa-thumbs-down"></i>
                <input type="number" disabled value="<?php echo $row2['replyCommThDown'] ?>" id="replydown_<?php echo $row2['gameReplyID'] ?>"/>
            </span>
        </div>
    </div>
    <div class="comment-bottom">
        <div class="comment-avatar center">
            <img class="avatar" src="<?php echo $row2['url']; ?>"/>
        </div>
        <div class="gamecomment">
            <?php 
                if($row2['deleted'] == true) {
                    echo "<em>This reply was deleted by Motion Sickness Gaming administration</em>";
                } else {
                    echo $row2['replyComment']; 
                }
            ?>
        </div>
        <div class="reply">
            <p>
                <?php if($_SESSION['userid'] == $row2['userID']) {
                    ?>
                <a href="#" onclick="editComment('gamereply', <?php echo $row2['gameReplyID'] ?>);">Edit</a> | 
                <a href="#" onclick="userdeletecomm('gamereply', <?php echo $row2['gameReplyID'] ?>);">Delete</a>
                <?php
                }
                ?>
            </p>
        </div>
    </div>
<!--    //This div is hidden, but will display when the 'edit' link is clicked-->  
    <div class="togglereplycomment" id="editgamereply_<?php echo $row2['gameReplyID'] ?>">
        <form class="pure-form pure-form-stacked" id="editGameComment" method="post" action="../../controller/editcomment.php">
            <fieldset>
                <textarea name="editgamecomment" class="comments"><?php echo $row2['replyComment'] ?></textarea>
                <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                <input type="hidden" name="gameReplyID" value="<?php echo $row2['gameReplyID'] ?>"/>
                <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                <input type="hidden" name="action_type" value="editgamereply"/>
                <button type="submit" class="pure-button pure-button-primary">Update</button>
            </fieldset>
        </form>
    </div> 

    <?php
            }
    }
    ?>
</div>