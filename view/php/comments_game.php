<div id="gamecomment">
<?php
$getcomments = getGameComments($_GET['gameID']);
if (!empty($getcomments)) {
    $counter = 0; 
    foreach($getcomments as $row) {
    $counter++;
    ?>
    <div class="outer-container">
    <div class="databaseComments" id="#comment_<?php echo $row['gameCommID'] ?>">
        <div class="userinfo entry<?php echo $counter ?>">            
            <p>
                <img class="avatar" src="<?php echo $row['url']; ?>"/>
                <span class="username"><?php echo $row['username'] ?></span>
            </p>
            <?php
                $getrep = getThumbs($row['userID']);
                $getreply = getGameReply($row['gameCommID']);
            ?> 
            <p class="commrep">
                <?php
                    include 'rep_comments.php';
                ?>
            </p>
<!--    //Checking fix reputation and adding a rep name based on the rep number-->
            <p class="fixrep">
                <?php
                    include 'rep_fix.php';
                ?>
            </p>
            <p class="date">
                <?php 
                    $phpdate = strtotime( $row['gameCommDateTime'] );
                    $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                    echo $mysqldate
                ?>
            </p>
        </div>
        <div class="actualcomment">
            <?php 
                if($row['deleted'] == true) {
                    echo "<em>This comment was deleted by Motion Sickness Gaming administration</em>";
                } else {
                    echo $row['gameComment']; 
                }
                if(isset($_SESSION['userid'])) {
                    $getThRec1 = getuserThumbRecords($_SESSION['userid'], 'gameCommID', $row['gameCommID']);
                }
            ?>
        </div>
        <div class="vote">
            <p class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec1)) { ?> onclick="updatethumb('gamecomm', 'up', <?php echo $row['gameCommID']; ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide1_<?php echo $row['gameCommID'] ?>">
                <i class="fas fa-thumbs-up"></i>
                <input type="number" disabled value="<?php echo $row['gameCommThUp']; ?>" id="up_<?php echo $row['gameCommID'] ?>"/>
            </p> 
            <p class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec1)) { ?> onclick="updatethumb('gamecomm', 'down', <?php echo $row['gameCommID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide2_<?php echo $row['gameCommID'] ?>">
                <i class="fas fa-thumbs-down"></i>
                <input type="number" disabled value="<?php echo $row['gameCommThDown'] ?>" id="down_<?php echo $row['gameCommID'] ?>"/>
            </p>
            <?php if(!empty($getThRec1) && $getThRec1['thumbType'] == "up") { ?>
            <p class="small">You liked this</p>
            <?php
                } else if(!empty($getThRec1) && $getThRec1['thumbType'] == "down") { ?>
            <p class="small">You disliked this</p>
            <?php
                }
            ?>
        </div>
        <div class="reply">
            <?php
                //Only display reply link if signed in
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
            ?>
<!--                //On click will display reply comment container-->
                    <a href="#comment_<?php echo $row['gameCommID'] ?>" onclick="togglereply(<?php echo $row['gameCommID'] ?>);">Reply</a>
            <?php
                }
                //Get number of replies 
                $getreplies = getReplyNumber($row['gameCommID']);
            ?>
            <p>
<!--    //displays number of replies as link-->
                <a href="#comment_<?php echo $row['gameCommID'] ?>" onclick="toggleviewreply(<?php echo $row['gameCommID'] ?>);">
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
        </div>
<!--    //This div is hidden, but will display when the 'reply' link is clicked-->
        <div class="togglereplycomment" id="reply_<?php echo $row['gameCommID'] ?>">
            <form class="pure-form pure-form-stacked" id="replyGameComment" method="post" action="../../controller/addcomment.php">
                <fieldset>
                    <textarea name="replygamecomment" class="comments"></textarea>
                    <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                    <input type="hidden" name="gamecommID" value="<?php echo $row['gameCommID'] ?>"/>
                    <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                    <input type="hidden" name="action_type" value="addgamereplycomment"/>
                    <button type="submit" class="pure-button pure-button-primary">Reply</button>
                </fieldset>
            </form>
        </div>
        </div>
<!-- //Reply section is hidden until the 'View x replies' link is clicked       -->
        <div class="replies" id="replyview_<?php echo $row['gameCommID'] ?>">
            <?php
                foreach($getreply as $row2) {
            ?>
            <div class="userinfo2">
                <p>
                    <img class="avatar" src="<?php echo $row2['url']; ?>"/>
                    <span class="username"><?php echo $row2['username'] ?></span>
                </p>
                <?php
                    $getrep = getThumbs($row2['userID']);
                ?>
<!--    //Checking comment reputation and adding a rep name based on the rep number-->
                <p class="commrep">
                    <?php
                        include 'rep_comments.php';
                    ?>
                </p>
<!--    //Checking fix reputation and adding a rep name based on the rep number-->
                <p class="fixrep">
                    <?php
                        include 'rep_fix.php';
                    ?>
                </p>
                <p class="date"><?php
                    $phpdate = strtotime( $row2['replyCommDateTime'] );
                    $mysqldate = date( 'd-m-Y g:i A', $phpdate );
//                        echo $row['gameCommDateTime'] 
                    echo $mysqldate
//                        echo $row2['replyCommDateTime'] 
                    ?></p>
            </div>
            <div class="actualcomment2">
                <?php 
                    if($row2['deleted'] == true) {
                        echo "<em>This reply was deleted by Motion Sickness Gaming administration</em>";
                    } else {
                        echo $row2['replyComment']; 
                    }
                    if(isset($_SESSION['userid'])) {
                        $getThRec2 = getuserThumbRecords($_SESSION['userid'], 'gameReplyID', $row2['gameReplyID']);
                    }
                ?>
            </div>
            <div class="vote2">
                <p class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec2)) { ?> onclick="updatethumb('gamereply', 'up', <?php echo $row2['gameReplyID'] ?>, <?php echo $row2['userID'] ?>)"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                    <i class="fas fa-thumbs-up"></i>
                    <input type="number" disabled value="<?php echo $row2['replyCommThUp'] ?>" id="replyup_<?php echo $row2['gameReplyID'] ?>"/>
                </p>
                <p class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec2)) { ?> onclick="updatethumb('gamereply', 'down', <?php echo $row2['gameReplyID'] ?>, <?php echo $row2['userID'] ?>)"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                    <i class="fas fa-thumbs-down"></i>
                    <input type="number" disabled value="<?php echo $row2['replyCommThDown'] ?>" id="replydown_<?php echo $row2['gameReplyID'] ?>"/>
                </p>
                <?php if(!empty($getThRec2) && $getThRec2['thumbType'] == "up") { ?>
                <p class="small">You liked this</p>
                <?php
                    } else if(!empty($getThRec2) && $getThRec2['thumbType'] == "down") { ?>
                <p class="small">You disliked this</p>
                <?php
                    }
                ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    }
} else {
    ?>
        <p class="nocomments">No comments to display</p>
<?php
}
    //If user is logged in then display comment container else display login ore register
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
?>
<div class="addcomment">
        <form class="pure-form pure-form-stacked" id="gameComment" method="post" action="../../controller/addcomment.php">
            <fieldset>
                <textarea name="gamecomment" class="comment" id="gamecomment" onchange="validateForm();"></textarea>
                <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                <input type="hidden" name="action_type" value="addgamecomment"/>
                <button type="submit" class="pure-button pure-button-primary">Comment</button>
            </fieldset>
            <?php
                include 'error_section.php';
            ?>            
            <div id="gamecomment_error"></div>
        </form>
    </div>
    <?php
        } else {
    ?>
    <div class="addcomment">
        <p>To vote, add a comment or reply, please <a class="yellow" href="login.php?gameID=<?php echo $_GET['gameID'] ?>">Login</a> or <a class="yellow" href="register.php?gameID=<?php echo $_GET['gameID'] ?>">Register</a></p>
    </div>
    <?php
        }
    ?>
<!--
<script>             
    $(document).ready(function() {
        $('.comment').richText();
    });       
</script>
-->
</div>