<div id="fixcomment">
<?php
    $getfixes = getFixes($_GET['gameID']);
    if (!empty($getfixes)) {
        foreach($getfixes as $row) {
?>
<!-- GAME FIXES ---------------------------------------------------->
        <div class="fix">
            <div class="userinfofix"> 
                <span>
                    <img class="avatar" src="<?php echo $row['url']; ?>"/>
                </span>
                <span class="username"><?php echo $row['username']; ?></span>
                <?php $getrep = getThumbs($row['userID']); ?>
                <span class="fixrep">
                    <?php 
                        include 'rep_fix.php'; 
                    ?>
                </span>
                <span class="date"><?php 
                        $phpdate = strtotime( $row['fixDateTime'] );
                        $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                        echo $mysqldate
                    ?></span>
            </div>
            <div class="votefix">
                <div class="left800">
                    <?php
                        if(isset($_SESSION['userid'])) {
                            $getThRec3 = getuserThumbRecords($_SESSION['userid'], 'fixID', $row['fixID']);
                        }
                    ?>
                    <p class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec3)) { ?> onclick="updatethumb('fix', 'up', <?php echo $row['fixID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                        <i class="fas fa-thumbs-up"></i>
                        <input type="number" disabled value="<?php echo $row['fixThUp'] ?>" id="fixup_<?php echo $row['fixID'] ?>"/>
                    </p>
                    <p class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec3)) { ?> onclick="updatethumb('fix', 'down', <?php echo $row['fixID'] ?>, <?php echo $row['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                        <i class="fas fa-thumbs-down"></i>
                        <input type="number" disabled value="<?php echo $row['fixThDown'] ?>" id="fixdown_<?php echo $row['fixID'] ?>"/>
                    </p>
                    <?php if(!empty($getThRec3) && $getThRec3['thumbType'] == "up") { ?>
                    <p class="small">You liked this</p>
                    <?php
                        } else if(!empty($getThRec3) && $getThRec3['thumbType'] == "down") { ?>
                    <p class="small">You disliked this</p>
                    <?php
                        }
                    ?>
                </div>
                <div class="right800">
                    <p>
                        <?php
                        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
                        ?>
                        <a href="#fixcomment_<?php echo $row['fixID'] ?>" onclick="toggleaddfixcomment(<?php echo $row['fixID'] ?>)">Comment</a>
                        <?php
                        }
                        $getreplies = getFixCommentNumber($row['fixID']);
                        ?>
                    </p>
                    <!-- Displays number of comments as a link-->
                    <p>
                        <a href="#fixcomments_<?php echo $row['fixID'] ?>"  onclick="togglefixcomment(<?php echo $row['fixID'] ?>)">
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
                </div>
            </div>
            <div class="actualfix">
                <?php 
                    if($row['deleted'] == true) {
                        echo "<em>This fix was deleted by Motion Sickness Gaming administration</em>";
                    } else {
                        echo $row['fixInfo']; 
                    }
                ?>
            </div>
            
        </div>
        
    <div class="databaseComments2">

<!--Add comment for fix    ------------------------------------->
                <!-- This div is hidden, but will display when the 'reply' link is clicked-->
            <div class="togglereplycomment left" id="fixcomment_<?php echo $row['fixID'] ?>">
                <form class="pure-form pure-form-stacked" id="fixComment" method="post" action="../../controller/addcomment.php">
                    <fieldset>
                        <textarea name="fixcomment" class="comments"></textarea>
                        <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                        <input type="hidden" name="fixID" value="<?php echo $row['fixID'] ?>"/>
                        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                        <input type="hidden" name="action_type" value="addfixcomment"/>
                        <button type="submit" class="pure-button pure-button-primary">Comment</button>
                    </fieldset>
                </form>
            </div>

<!--Comments on game fixes ------------------------------------>
            <div class="outercontainerhid" id="fixcomments_<?php echo $row['fixID'] ?>">

                <?php 
                $getfixcomm = getFixComments($row['fixID']); 
                foreach($getfixcomm as $row1) {
                ?>
                <div class="fixcomment">
                <div class="userinfo3">
                    <p>
                        <img class="avatar" src="<?php echo $row1['url']; ?>"/>
                        <span class="username"><?php echo $row1['username'] ?></span>
                    </p>
                    <?php $getrep = getThumbs($row1['userID']); ?>
                    <p class="commrep">
                        <?php
                            include 'rep_comments.php';
                        ?>
                    </p>
                    <p class="fixrep">
                        <?php
                            include 'rep_fix.php';
                        ?>
                    </p>
                    <p class="date"><?php
                        $phpdate = strtotime( $row1['fixCommDateTime'] );
                        $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                        echo $mysqldate
//                    echo $row1['fixCommDateTime']; 
                        ?></p>
                </div>
                <div class="actualcomment3">
                    <?php 
                        if($row1['deleted'] == true) {
                            echo "<em>This comment was deleted by Motion Sickness Gaming administration</em>";
                        } else {
                            echo $row1['fixComment']; 
                        }
                    if(isset($_SESSION['userid'])) {
                        $getThRec4 = getuserThumbRecords($_SESSION['userid'], 'fixCommID', $row1['fixCommID']);
                    }
                    ?>
                </div>                 
                <div class="vote3">
                    <div class="left800">
                    <p class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec4)) { ?> onclick="updatethumb('fixcomm', 'up', <?php echo $row1['fixCommID'] ?>, <?php echo $row1['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                        <i class="fas fa-thumbs-up"></i>
                        <input type="number" disabled value="<?php echo $row1['fixCommThUp'] ?>" id="fixcommup_<?php echo $row1['fixCommID'] ?>"/>
                    </p>
                    <p class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec4)) { ?> onclick="updatethumb('fixcomm', 'down', <?php echo $row1['fixCommID'] ?>, <?php echo $row1['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                        <i class="fas fa-thumbs-down"></i>
                        <input type="number" disabled value="<?php echo $row1['fixCommThDown'] ?>" id="fixcommdown_<?php echo $row1['fixCommID'] ?>"/>
                    </p>
                    <?php if(!empty($getThRec4) && $getThRec3['thumbType'] == "up") { ?>
                    <p class="small">You liked this</p>
                    <?php
                        } else if(!empty($getThRec4) && $getThRec3['thumbType'] == "down") { ?>
                    <p class="small">You disliked this</p>
                    <?php
                        }
                    ?>
                    </div>
                    <div class="right800">
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
                        ?>
                    
                        <p>
                        <a href="#fixreply_<?php echo $row1['fixCommID'] ?>" onclick="togglefixreply(<?php echo $row1['fixCommID'] ?>);">Reply</a>
                        </p>
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
            </div>
<!--Add a reply to comments on game fixes ----------------------
                <!-- This div is hidden, but will display when the 'reply' link is clicked-->
                <div class="togglereplycomment" id="fixreply_<?php echo $row1['fixCommID'] ?>">
                    <form class="pure-form pure-form-stacked" id="replyGameComment" method="post" action="../../controller/addcomment.php">
                        <fieldset>
                            <textarea name="fixreplycomment" class="comments"></textarea>
                            <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                            <input type="hidden" name="fixcommID" value="<?php echo $row1['fixCommID'] ?>"/>
                            <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                            <input type="hidden" name="action_type" value="addfixreplycomment"/>
                            <button type="submit" class="pure-button pure-button-primary">Reply</button>
                        </fieldset>
                    </form>
                </div>
                    
<!--Replies to comments -------------------------------------------->
                <div class="replies" id="replyfixview_<?php echo $row1['fixCommID'] ?>">
                    <?php 
                    $getfixreply = getFixReplies($row1['fixCommID']); 
                    foreach($getfixreply as $row2) {
                    ?>
                    <div class="userinfo2">
                        <p>
                            <img class="avatar" src="<?php echo $row2['url']; ?>"/>
                            <span class="username"><?php echo $row2['username'] ?></span>
                        </p>
                        <?php $getrep = getThumbs($row2['userID']); ?>
                        <p class="commrep">
                            <?php
                                include 'rep_comments.php';
                            ?>
                        </p>
                        <p class="fixrep">
                            <?php
                                include 'rep_fix.php';
                            ?>
                        </p>
                        <p class="date"><?php 
                        $phpdate = strtotime( $row2['fixReplyDateTime'] );
                        $mysqldate = date( 'd-m-Y g:i A', $phpdate );
                        echo $mysqldate
//                        echo $row2['fixReplyDateTime']; 
                            ?></p>
                    </div>
                    <div class="actualcomment2">
                        <?php 
                            if($row2['deleted'] == true) {
                                echo "<em>This reply was deleted by Motion Sickness Gaming administration</em>";
                            } else {
                                echo $row2['fixReply']; 
                            }
                        if(isset($_SESSION['userid'])) {
                            $getThRec5 = getuserThumbRecords($_SESSION['userid'], 'fixReplyID', $row2['fixReplyID']);
                        }
                        ?>
                    </div>
                    <div class="vote2">
                        <p class="green" <?php if(isset($_SESSION['userid']) && empty($getThRec5)) { ?> onclick="updatethumb('fixreply', 'up', <?php echo $row2['fixReplyID'] ?>, <?php echo $row2['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                            <i class="fas fa-thumbs-up"></i>
                            <input type="number" disabled value="<?php echo $row2['fixReplyThUp'] ?>" id="fixreplyup_<?php echo $row2['fixReplyID'] ?>"/>
                        </p>
                        <p class="orange" <?php if(isset($_SESSION['userid']) && empty($getThRec5)) { ?> onclick="updatethumb('fixreply', 'down', <?php echo $row2['fixReplyID'] ?>, <?php echo $row2['userID'] ?>);"<?php } else if(!isset($_SESSION['userid'])) { ?> onclick="loginreq(<?php echo $_GET['gameID']; ?>);"<?php } ?>>
                            <i class="fas fa-thumbs-down"></i>
                            <input type="number" disabled value="<?php echo $row2['fixReplyThDown'] ?>" id="fixreplydown_<?php echo $row2['fixReplyID'] ?>"/>
                        </p>
                        <?php if(!empty($getThRec5) && $getThRec5['thumbType'] == "up") { ?>
                        <p class="small">You liked this</p>
                        <?php
                            } else if(!empty($getThRec5) && $getThRec5['thumbType'] == "down") { ?>
                        <p class="small">You disliked this</p>
                        <?php
                            }
                        ?>
                    </div>

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
        <p class="nocomments">No fixes to display</p>
    <?php
    }
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
    ?>
    <div class="addcomment">
    </div>
    <?php
        } else {
    ?>
    <div class="addcomment">
        <p>To vote, add a game fix, comment or reply, please <a class="yellow" href="login.php?gameID=<?php echo $_GET['gameID'] ?>">Login</a> or <a class="yellow" href="register.php?gameID=<?php echo $_GET['gameID'] ?>">Register</a></p>
    </div>
    <?php
        }
    ?>
</div>