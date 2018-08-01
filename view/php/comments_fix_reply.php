<!--Replies to comments -------------------------------------------->
<div class="replies" id="replyfixview_<?php echo $row1['fixCommID'] ?>">
    <?php 
    $getfixreply = getFixReplies($row1['fixCommID']); 
    foreach($getfixreply as $row2) {
    ?>
    <div class="comment-top">
        <div class="userinfo">
            <span class="username"><?php echo $row2['username'] ?></span>
            <span class="commrep">
                <?php
                    $getrep = getThumbs($row2['userID']);
                    include 'rep_comments.php';
                ?>
            </span>
            <span class="date">
                <?php 
                    $phpdate = strtotime( $row2['fixReplyDateTime'] );
                    $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                    echo $mysqldate
                ?>
            </span>
        </div>
        <div class="vote">
            <span class="small">
                <?php
                    if(isset($_SESSION['userid'])) {
                        $getThRec5 = getuserThumbRecords($_SESSION['userid'], 'fixReplyID', $row2['fixReplyID']);
                    }
                    if(!empty($getThRec5) && $getThRec5['thumbType'] == "up") { 
                        echo 'You liked this';
                    } else if(!empty($getThRec5) && $getThRec5['thumbType'] == "down") {
                        echo 'You disliked this';
                    }
                ?>
            </span>
            <span class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec5)) { ?> onclick="updatethumb('fixreply', 'up', <?php echo $row2['fixReplyID'] ?>, <?php echo $row2['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide9_<?php echo $row2['fixReplyID'] ?>">
                <i class="fas fa-thumbs-up"></i>
                <input type="number" disabled value="<?php echo $row2['fixReplyThUp'] ?>" id="fixreplyup_<?php echo $row2['fixReplyID'] ?>"/>
            </span>
            <span class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec5)) { ?> onclick="updatethumb('fixreply', 'down', <?php echo $row2['fixReplyID'] ?>, <?php echo $row2['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide10_<?php echo $row2['fixReplyID'] ?>">
                <i class="fas fa-thumbs-down"></i>
                <input type="number" disabled value="<?php echo $row2['fixReplyThDown'] ?>" id="fixreplydown_<?php echo $row2['fixReplyID'] ?>"/>
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
                    echo $row2['newfixReply']; 
                }
            ?>
        </div>
        <div class="reply">
            <p>
                <?php if($_SESSION['userid'] == $row2['userID']) {
                    ?>
                <a role="button" onclick="editComment('fixreply', <?php echo $row2['fixReplyID'] ?>);">Edit</a> | 
                <a role="button" onclick="userdeletecomm('fixreply', <?php echo $row2['fixReplyID'] ?>);">Delete</a>
                <?php
                }
                ?>
            </p>
        </div>
    </div>
<!--    //This div is hidden, but will display when the 'edit' link is clicked-->  
    <div class="togglereplycomment" id="editfixreply_<?php echo $row2['fixReplyID'] ?>">
        <form class="pure-form pure-form-stacked" id="editGameComment" method="post" action="../../controller/editcomment.php">
            <fieldset>
                <textarea name="editgamecomment" class="comments"><?php echo $row2['fixReply'] ?></textarea>
                <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                <input type="hidden" name="fixReplyID" value="<?php echo $row2['fixReplyID'] ?>"/>
                <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                <input type="hidden" name="action_type" value="editfixreply"/>
                <button type="submit" class="pure-button pure-button-primary">Update</button>
            </fieldset>
        </form>
    </div> 
    <?php
    }
    ?>
</div>