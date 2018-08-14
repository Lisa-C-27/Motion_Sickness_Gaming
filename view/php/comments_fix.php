<div id="fixcomment">
<?php
    $getfixes = getFixes($_GET['gameID']);
    if (!empty($getfixes)) {
        foreach($getfixes as $row) {
?>
<!-- GAME FIXES ---------------------------------------------------->
    <div class="outer-container">
        <div class="databaseComments fix">
            <div class="comment-top">
                <div class="userinfo"> 
                    <span class="username"><?php echo $row['username']; ?></span>
                    <span class="fixrep">
                        <?php 
                            $getrep = getThumbs($row['userID']);
                            include 'rep_fix.php'; 
                        ?>
                    </span>
                    <span class="date">
                        <?php 
                            $phpdate = strtotime( $row['fixDateTime'] );
                            $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                            echo $mysqldate
                        ?>
                    </span>
                </div>
                <div class="vote">
                    <span class="small">
                        <?php
                            if(isset($_SESSION['userid'])) {
                                $getThRec3 = getuserThumbRecords($_SESSION['userid'], 'fixID', $row['fixID']);
                            }
                            if(!empty($getThRec3) && $getThRec3['thumbType'] == "up") { 
                                echo 'This worked for you';
                            } else if(!empty($getThRec3) && $getThRec3['thumbType'] == "down") { 
                                echo 'This didn\'t work for you';
                            } else {
                                echo 'Did this fix work for you?';
                            }
                        ?>
                    </span>
                    <span class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec3)) { ?> onclick="updatethumb('fix', 'up', <?php echo $row['fixID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide5_<?php echo $row['fixID'] ?>">
                        <i class="fas fa-thumbs-up"></i>
                        <input type="number" disabled value="<?php echo $row['fixThUp'] ?>" id="fixup_<?php echo $row['fixID'] ?>"/>
                    </span>
                    <span class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec3)) { ?> onclick="updatethumb('fix', 'down', <?php echo $row['fixID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?> id="hide6_<?php echo $row['fixID'] ?>">
                        <i class="fas fa-thumbs-down"></i>
                        <input type="number" disabled value="<?php echo $row['fixThDown'] ?>" id="fixdown_<?php echo $row['fixID'] ?>"/>
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
                                echo "<em>This fix was deleted by Motion Sickness Gaming administration</em>";
                            } else {
                                echo $row['newfixInfo']; 
                            }
                        ?>
                    </p>
                </div>
                <div class="reply">
                    <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
                    ?>
                        <a role="button" onclick="toggleaddfixcomment(<?php echo $row['fixID'] ?>)">Comment</a>
                    <?php
                        }
                        $getreplies = getFixCommentNumber($row['fixID']);
                    ?>
                    <!-- Displays number of comments as a link-->
                    <p>
                        <a role="button" onclick="togglefixcomment(<?php echo $row['fixID'] ?>)">
                        <?php
                            if($getreplies['replies'] == 0) {
                                echo "No comments";
                            } else if ($getreplies['replies'] == 1) {
                        ?>
                            View <?php echo $getreplies['replies']; ?> comment <i class="fas fa-chevron-down"></i>
                        <?php
                            }else {
                        ?>
                            View <?php echo $getreplies['replies']; ?> comments <i class="fas fa-chevron-down"></i>
                        <?php
                            }
                        ?>
                        </a>
                    </p>
                    <p>
                        <?php if(isset($_SESSION['userid'])) {
                            if($_SESSION['userid'] == $row['userID']) {
                        ?>
                        <a role="button" onclick="editComment('fix', <?php echo $row['fixID'] ?>);">Edit</a> | 
                        <a role="button" onclick="userdeletecomm('fix', <?php echo $row['fixID'] ?>);">Delete</a>
                        <?php
                        }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <!--Add comment for fix    ------------------------------------->
    <!-- This div is hidden, but will display when the 'reply' link is clicked-->
        <div class="togglereplycomment" id="fixcomment_<?php echo $row['fixID'] ?>">
            <form class="pure-form pure-form-stacked" id="fixComment" method="post" action="../../controller/addcomment.php">
                <fieldset>
                    <textarea name="fixcomment" class="comments"></textarea>
                    <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                    <input type="hidden" name="fixID" value="<?php echo $row['fixID'] ?>"/>
                    <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                    <input type="hidden" name="action_type" value="addfixcomment"/>
                    <button type="submit" class="pure-button pure-button-primary">Comment</button>
                </fieldset>
            </form>
        </div>
<!--    //This div is hidden, but will display when the 'edit' link is clicked-->  
        <div class="togglereplycomment" id="editfix_<?php echo $row['fixID'] ?>">
            <form class="pure-form pure-form-stacked" id="editGameComment" method="post" action="../../controller/editcomment.php">
                <fieldset>
                    <textarea name="editgamecomment" class="comments"><?php echo $row['fixInfo'] ?></textarea>
                    <input type="hidden" name="userID" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid']; } ?>"/>
                    <input type="hidden" name="fixID" value="<?php echo $row['fixID'] ?>"/>
                    <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                    <input type="hidden" name="action_type" value="editfix"/>
                    <button type="submit" class="pure-button pure-button-primary">Update</button>
                </fieldset>
            </form>
        </div> 
          
    <?php
        include 'comments_fix_comment.php';
    ?>                          
    </div>
    <?php
        }
        } else {
    ?>
        <p class="nocomments">No fixes to display</p>
    <?php
    }
    ?>  
</div>