<div id="fixcomment">
<?php
    $getfixes = getFixes($_GET['gameID']);
    if (!empty($getfixes)) {
        foreach($getfixes as $row) {
?>
<!-- GAME FIXES ---------------------------------------------------->
        <div class="fix">
            <div class="userinfofix"> 
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
                <p class="green" onclick="updatethumb_fix('up', <?php echo $row['fixID'] ?>);">
                    <i class="fas fa-thumbs-up"></i>
                    <input type="number" disabled value="<?php echo $row['fixThUp'] ?>" id="fixup_<?php echo $row['fixID'] ?>"/>
                </p>
                <p class="orange" onclick="updatethumb_fix('down', <?php echo $row['fixID'] ?>);">
                    <i class="fas fa-thumbs-down"></i>
                    <input type="number" disabled value="<?php echo $row['fixThDown'] ?>" id="fixdown_<?php echo $row['fixID'] ?>"/>
                </p>
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
            <div class="actualfix">
                <?php echo $row['fixInfo']; ?>
            </div>
            
        </div>
        <div class="databaseComments">

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
            <div class="fixcomment" id="fixcomments_<?php echo $row['fixID'] ?>">

                <?php 
                $getfixcomm = getFixComments($row['fixID']); 
                foreach($getfixcomm as $row1) {
                ?>    

                <div class="userinfo3">
                    <p class="username"><?php echo $row1['username']; ?></p>
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
                    <?php echo $row1['fixComment']; ?>
                </div>                 
                <div class="vote3">
                    <p class="green" onclick="updatethumb_fixcomm('up', <?php echo $row1['fixCommID'] ?>);">
                        <i class="fas fa-thumbs-up"></i>
                        <input type="number" disabled value="<?php echo $row1['fixCommThUp'] ?>" id="fixcommup_<?php echo $row1['fixCommID'] ?>"/>
                    </p>
                    <p class="orange" onclick="updatethumb_fixcomm('down', <?php echo $row1['fixCommID'] ?>);">
                        <i class="fas fa-thumbs-down"></i>
                        <input type="number" disabled value="<?php echo $row1['fixCommThDown'] ?>" id="fixcommdown_<?php echo $row1['fixCommID'] ?>"/>
                    </p>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
                        ?>
                    <div>
                    <a href="#fixreply_<?php echo $row1['fixCommID'] ?>" onclick="togglefixreply(<?php echo $row1['fixCommID'] ?>);">Reply</a>
                    </div>
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
                        <p class="username"><?php echo $row2['username']; ?></p>
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
                        <?php echo $row2['fixReply']; ?>
                    </div>
                    <div class="vote2">
                        <p class="green" onclick="updatethumb_fixreply('up', <?php echo $row2['fixReplyID'] ?>);">
                            <i class="fas fa-thumbs-up"></i>
                            <input type="number" disabled value="<?php echo $row2['fixReplyThUp'] ?>" id="fixreplyup_<?php echo $row2['fixReplyID'] ?>"/>
                        </p>
                        <p class="orange" onclick="updatethumb_fixreply('down', <?php echo $row2['fixReplyID'] ?>);">
                            <i class="fas fa-thumbs-down"></i>
                            <input type="number" disabled value="<?php echo $row2['fixReplyThDown'] ?>" id="fixreplydown_<?php echo $row2['fixReplyID'] ?>"/>
                        </p>
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
        <p>To add a game fix, comment or reply, please <a class="yellow"  href="login.php">Login</a> or <a class="yellow" href="register.php">Register</a></p>
    </div>
    <?php
        }
    ?>
</div>