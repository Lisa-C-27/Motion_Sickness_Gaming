<div id="gamecomment">
<?php
$getcomments = getGameComments($_GET['gameID']);
if (!empty($getcomments)) {
    foreach($getcomments as $row) {
    ?>
        <div class="databaseComments" id="#comment_<?php echo $row['gameCommID'] ?>">
            <div class="userinfo">
                <p class="username"><?php echo $row['username'] ?></p>
                <?php
                    $getrep = getThumbs($row['userID']);
                    $getreply = getGameReply($row['gameCommID']);
                ?>
    <!--
        //For debugging
    //                    print_r($getrep); 
    //                    echo '<br>';
    //                    echo '<br>';

        //Checking comment reputation and adding a rep name based on the rep number
    -->   
                <p class="commrep">
                    <?php
                        if($getrep['commthumbs'] <= 50) {
                            echo 'Newbie';
                        } else if($getrep['commthumbs'] > 50 && $getrep['commthumbs'] <= 500) {
                            echo 'Partially Sick Member';
                        } else if($getrep['commthumbs'] > 500) {
                            echo 'Fully Sick Member';
                        }
                    ?>
                </p>
    <!--    //Checking fix reputation and adding a rep name based on the rep number-->
                <p class="fixrep">
                    <?php
                        if($getrep['fixthumbs'] < 1) {
                            //Display nothing
                        } else if($getrep['fixthumbs'] <= 100) {
                            echo 'Beginner Fixer';
                        } else if($getrep['fixthumbs'] > 100 && $getrep['fixthumbs'] <= 500) {
                            echo 'Intermediate Fixer';
                        } else if($getrep['fixthumbs'] > 500) {
                            echo 'Ultimate Fixer';
                        }
                    ?>
                </p>
                <p class="date"><?php echo $row['gameCommDateTime'] ?></p>
            </div>
            <div class="actualcomment"><?php echo $row['gameComment'] ?></div>
            <div class="vote">
                <span class="green">
                    <i class="fas fa-thumbs-up"></i>
                    <span><?php echo $row['gameCommThUp'] ?></span>
                </span>
                <span class="red">
                    <i class="fas fa-thumbs-down"></i>
                    <span><?php echo $row['gameCommThDown'] ?></span>
                </span>
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
                        View <?php echo $getreplies['replies'] ?> replies
                    </a>
                </p>
            </div>
    <!--    //This div is hidden, but will display when the 'reply' link is clicked-->
            <div class="togglereplycomment" id="reply_<?php echo $row['gameCommID'] ?>">
                <form class="pure-form pure-form-stacked" id="replyGameComment" method="post" action="../../controller/addcomment.php">
                    <fieldset>
                        <textarea name="replygamecomment" rows="3" cols="60"></textarea>
                        <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                        <input type="hidden" name="gamecommID" value="<?php echo $row['gameCommID'] ?>"/>
                        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                        <input type="hidden" name="action_type" value="addgamereplycomment"/>
                        <button type="submit" class="pure-button pure-button-primary">Reply</button>
                    </fieldset>
                </form>
            </div>
    <!-- //Reply section is hidden until the 'View x replies' link is clicked       -->
            <div class="replies" id="replyview_<?php echo $row['gameCommID'] ?>">
                <?php
                    foreach($getreply as $row2) {
                ?>
                <div class="userinfo2">
                    <p class="username"><?php echo $row2['username'] ?></p>
                    <?php
                        $getrep = getThumbs($row2['userID']);
                    ?>
    <!--    //Checking comment reputation and adding a rep name based on the rep number-->
                    <p class="commrep">
                        <?php
                            if($getrep['commthumbs'] <= 50) {
                                echo 'Newbie';
                            } else if($getrep['commthumbs'] > 50 && $getrep['commthumbs'] <= 500) {
                                echo 'Partially Sick Member';
                            } else if($getrep['commthumbs'] > 500) {
                                echo 'Fully Sick Member';
                            }
                        ?>
                    </p>
    <!--    //Checking fix reputation and adding a rep name based on the rep number-->
                    <p class="fixrep">
                        <?php
                            if($getrep['fixthumbs'] < 1) {
                                //Display nothing
                            } else if($getrep['fixthumbs'] <= 100) {
                                echo 'Beginner Fixer';
                            } else if($getrep['fixthumbs'] > 100 && $getrep['fixthumbs'] <= 500) {
                                echo 'Intermediate Fixer';
                            } else if($getrep['fixthumbs'] > 500) {
                                echo 'Ultimate Fixer';
                            }
                        ?>
                    </p>
                    <p class="date"><?php echo $row2['replyCommDateTime'] ?></p>
                </div>
                <div class="actualcomment2">
                    <?php echo $row2['replyComment'] ?>
                </div>
                <div class="vote2">
                    <span class="green">
                        <i class="fas fa-thumbs-up"></i>
                        <span><?php echo $row2['replyCommThUp'] ?></span>
                    </span>
                    <span class="red">
                        <i class="fas fa-thumbs-down"></i>
                        <span><?php echo $row2['replyCommThDown'] ?></span>
                    </span>
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
                <textarea name="gamecomment" rows="3" cols="60"></textarea>
                <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                <input type="hidden" name="action_type" value="addgamecomment"/>
                <button type="submit" class="pure-button pure-button-primary">Comment</button>
            </fieldset> 
        </form>
    </div>
    <?php
        } else {
    ?>
    <div class="addcomment">
        <p>To add a comment or reply, please <a href="login.php">Login</a> or <a href="register.php">Register</a></p>
    </div>
    <?php
        }
    ?>
</div>