<!--Comments on game fixes ------------------------------------>
<div class="outer-container">
    <div class="databaseComments fixComments" id="fixcomments_<?php echo $row['fixID'] ?>">
<?php 
    $getfixcomm = getFixComments($row['fixID']); 
    foreach($getfixcomm as $row1) {
?>
        <div class="comment-top">
            <div class="userinfo">
                <span class="username"><?php echo $row1['username'] ?></span>
                <span class="commrep">
                    <?php
                        $getrep = getThumbs($row1['userID']);
                        include 'rep_comments.php';
                    ?>
                </span>
                <span class="date">
                    <?php
                        $phpdate = strtotime( $row1['fixCommDateTime'] );
                        $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                        echo $mysqldate
                    ?>
                </span>
            </div>
            <div class="vote">
                <span class="small">
                    <?php
                        if(isset($_SESSION['userid'])) {
                            $getThRec4 = getuserThumbRecords($_SESSION['userid'], 'fixCommID', $row1['fixCommID']);
                        }
                        if(!empty($getThRec4) && $getThRec3['thumbType'] == "up") {
                            echo 'You liked this';
                        } else if(!empty($getThRec4) && $getThRec3['thumbType'] == "down") {
                            echo 'You disliked this';
                        }
                    ?>
                </span>
                <span class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec4)) { ?> onclick="updatethumb('fixcomm', 'up', <?php echo $row1['fixCommID'] ?>, <?php echo $row1['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide7_<?php echo $row1['fixCommID'] ?>">
                    <i class="fas fa-thumbs-up"></i>
                    <input type="number" disabled value="<?php echo $row1['fixCommThUp'] ?>" id="fixcommup_<?php echo $row1['fixCommID'] ?>"/>
                </span>
                <span class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec4)) { ?> onclick="updatethumb('fixcomm', 'down', <?php echo $row1['fixCommID'] ?>, <?php echo $row1['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide8_<?php echo $row1['fixCommID'] ?>">
                    <i class="fas fa-thumbs-down"></i>
                    <input type="number" disabled value="<?php echo $row1['fixCommThDown'] ?>" id="fixcommdown_<?php echo $row1['fixCommID'] ?>"/>
                </span>
            </div>
        </div>
        <div class="comment-bottom">
            <div class="comment-avatar center">
                <img class="avatar" src="<?php echo $row1['url']; ?>"/>
            </div>
            <div class="gamecomment">
                <p>
                    <?php 
                        if($row1['deleted'] == true) {
                            echo "<em>This comment was deleted by Motion Sickness Gaming administration</em>";
                        } else {
                            echo $row1['fixComment']; 
                        }
                    ?>
                </p>
            </div>
            <div class="reply">    
            <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
            ?>
                <a href="#fixreply_<?php echo $row1['fixCommID'] ?>" onclick="togglefixreply(<?php echo $row1['fixCommID'] ?>);">Reply</a>
            <?php
                }
                $getreplies = getFixCommReplyNumber($row1['fixCommID']);
            ?>
                <p>
                <!--    //displays number of replies as link-->
                    <a href="#replyfixview_<?php echo $row1['fixCommID'] ?>" onclick="toggleviewfixcomm(<?php echo $row1['fixCommID'] ?>);">
                    <?php
                        if($getreplies['replies'] == 0) {
                            echo "No replies";
                        } else if ($getreplies['replies'] == 1) {
                            echo "View 1 reply ";
                            echo '<i class="fas fa-chevron-down"></i>';
                        } else {
                    ?>
                        View <?php echo $getreplies['replies'] ?> replies <i class="fas fa-chevron-down"></i>
                    <?php
                        }
                    ?>
                    </a>
                </p>
            </div>
        </div>               
<!--Add a reply to comments on game fixes ----------------------
<!-- This div is hidden, but will display when the 'reply' link is clicked-->
        <div class="togglereplycomment" id="fixreply_<?php echo $row1['fixCommID'] ?>">
            <form class="pure-form pure-form-stacked" id="replyGameComment" method="post" action="../../controller/addcomment.php">
                <fieldset>
                    <textarea name="fixreplycomment" class="comments"></textarea>
                    <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                    <input type="hidden" name="fixcommID" value="<?php echo $row1['fixCommID'] ?>"/>
                    <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                    <input type="hidden" name="action_type" value="addfixreplycomment"/>
                    <button type="submit" class="pure-button pure-button-primary">Reply</button>
                </fieldset>
            </form>
        </div>
        <?php
            include 'comments_fix_reply.php';
            }
        ?>
    </div>
</div>