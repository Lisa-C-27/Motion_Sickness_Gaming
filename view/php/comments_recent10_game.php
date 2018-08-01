<div id="gamecomments">
<?php
    
$getcomments = get10RecentComments($_GET['gameID']);

if (!empty($getcomments)) {
    foreach($getcomments as $row) {
    ?>
    <div class="outer-container">
        <div class="databaseComments" id="#comment_<?php echo $row['gameCommID'] ?>">
            <div class="comment-top">
                <div class="userinfo">  
                    <span class="username"><?php echo $row['username'] ?></span>
                    <span class="commrep">
                        <?php
                            $getrep = getThumbs($row['userID']);
                            $getreply = getGameReply($row['gameCommID']);
                            include 'rep_comments.php';
                        ?>
                    </span>
                    <span class="date">
                        <?php 
                            $phpdate = strtotime( $row['gameCommDateTime'] );
                            $mysqldate = date( 'd M Y g:i A', $phpdate );
                            echo $mysqldate
                        ?>
                    </span>
                </div>
                <div class="vote">
                    <span class="small">
                        <?php 
                            if(isset($_SESSION['userid'])) {
                                $getThRec1 = getuserThumbRecords($_SESSION['userid'], 'gameCommID', $row['gameCommID']);
                            }
                            if(!empty($getThRec1) && $getThRec1['thumbType'] == "up") { 
                                echo 'You liked this';
                            } else if(!empty($getThRec1) && $getThRec1['thumbType'] == "down") { 
                                echo 'You disliked this';
                            }
                        ?>
                    </span>
                    <span class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec1)) { ?> onclick="updatethumb('gamecomm', 'up', <?php echo $row['gameCommID']; ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide1_<?php echo $row['gameCommID'] ?>">
                        <i class="fas fa-thumbs-up"></i>
                        <input type="number" disabled value="<?php echo $row['gameCommThUp']; ?>" id="up_<?php echo $row['gameCommID'] ?>"/>
                    </span>
                    <span class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec1)) { ?> onclick="updatethumb('gamecomm', 'down', <?php echo $row['gameCommID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide2_<?php echo $row['gameCommID'] ?>">
                        <i class="fas fa-thumbs-down"></i>
                        <input type="number" disabled value="<?php echo $row['gameCommThDown'] ?>" id="down_<?php echo $row['gameCommID'] ?>"/>   
                    </span>
                </div>
            </div>
            <div class="comment-bottom">
                <div class="comment-avatar center">
                    <img class="avatar" src="<?php echo $row['url']; ?>"/>
                </div>
                <div class="gamecomment">
                    <p>
                        <?php 
                            if($row['deleted'] == true) {
                                echo "<em>This comment was deleted by Motion Sickness Gaming administration</em>";
                            } else {
                                echo $row['newgameComment']; 
                            }
                        ?>
                    </p>
                </div>
                <div class="reply">
                    <?php
                        //Only display reply link if signed in
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
                    ?>
        <!--            //On click will display reply comment container-->
                            <a role="button" onclick="togglereply(<?php echo $row['gameCommID'] ?>);">Reply</a>
                    <?php
                        }
                        //Get number of replies 
                        $getreplies = getReplyNumber($row['gameCommID']);
                    ?>
                    <p>
        <!--    //displays number of replies as link-->
                        <a role="button" onclick="toggleviewreply(<?php echo $row['gameCommID'] ?>);">
                            <?php
                        if ($getreplies['replies'] == 0) {
                            echo "No replies";
                        } else if ($getreplies['replies'] == 1) {
                            ?>
                            View
                            <?php
                             echo $getreplies['replies'] ?> reply <i class="fas fa-chevron-down"></i>
                            <?php
                        } else {
                            ?>
                            View
                            <?php
                        echo $getreplies['replies'] ?> replies <i class="fas fa-chevron-down"></i>
                            <?php
                        }
                        ?>
                        </a>
                    </p>
                    <p>
                        <?php 
                        if(isset($_SESSION['userid'])) {            if($_SESSION['userid'] == $row['userID']) {
                        ?>
                        <a role="button" onclick="editComment('gamecomm', <?php echo $row['gameCommID'] ?>);">Edit</a> | 
                        <a role="button" onclick="userdeletecomm('gamecomm', <?php echo $row['gameCommID'] ?>);">Delete</a>
                        <?php
                        }
                        }
                        ?>
                    </p>
                </div>
            </div>
        
    <!--    //This div is hidden, but will display when the 'reply' link is clicked-->
            <div class="togglereplycomment" id="reply_<?php echo $row['gameCommID'] ?>">
                <form class="pure-form pure-form-stacked" id="replyGameComment" method="post" action="../../controller/addcomment.php">
                    <fieldset>
                        <textarea name="replygamecomment" class="comments"></textarea>
                        <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                        <input type="hidden" name="gamecommID" value="<?php echo $row['gameCommID'] ?>"/>
                        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                        <input type="hidden" name="action_type" value="addgamereplycomment"/>
                        <button type="submit" class="pure-button pure-button-primary">Reply</button>
                    </fieldset>
                </form>
            </div>
    <!--    //This div is hidden, but will display when the 'edit' link is clicked-->  
            <div class="togglereplycomment" id="edit_<?php echo $row['gameCommID'] ?>">
                <form class="pure-form pure-form-stacked" id="editGameComment" method="post" action="../../controller/editcomment.php">
                    <fieldset>
                        <textarea name="editgamecomment" class="comments"><?php echo $row['gameComment'] ?></textarea>
                        <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                        <input type="hidden" name="gamecommID" value="<?php echo $row['gameCommID'] ?>"/>
                        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                        <input type="hidden" name="action_type" value="editgamecomment"/>
                        <button type="submit" class="pure-button pure-button-primary">Update</button>
                    </fieldset>
                </form>
            </div> 
        </div>
        <?php
            include 'comments_game_reply.php';
        ?>
    </div>
    <?php
    }
} else {
    ?>
        <p class="nocomments">No comments to display</p>
<?php
}
?>
</div>
<?php
    
    if($count1['count'] > 10) {
?>
<div class="center">
    <a href="individual_games.php?gameID=<?php echo $_GET['gameID']; ?>&showallcomments=yes" class="green">View more comments <i class="fas fa-chevron-down"></i></a>
</div>
<?php
    }
?>