<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
//This function is located in 'model/dbfunctions.php'
    $gamedetails = get_one_game($_GET['gameID']);
    $count = getFixCount($_GET['gameID']);
    $count1 = getCommentCount($_GET['gameID']);
?>
<div class="container page"> 
    <div class="game-button">
        <h1><?php echo $gamedetails['gameName'];?></h1>
    </div>
    <?php
        include 'game_vote.php';
    ?>
    <div class="comment-container"> 
        <?php
            //If user is logged in then display comment container else display login or register
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
?>
    <div id="comment_game">
        <form class="pure-form pure-form-stacked" id="gameComment" method="post" action="../../controller/addcomment.php">
            <fieldset>
                <p class="nomargin">Add a comment about the game or an in-game fix:</p>
                <textarea name="gamecomment" class="comment" id="gamecomment" onchange="validateForm();"></textarea>
                <div class="radios">
                    <input id="radiocomment" type="radio" name="type" value="comment" checked>
                    <label for="radiocomment">Comment </label>
                    <input id="radiofix" type="radio" name="type" value="fix">
                    <label for="radiofix">Fix</label>
                </div>
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
    <div id="comment_game">
        <p>To vote, add a fix, comment or reply, please <a class="green" href="login.php?gameID=<?php echo $_GET['gameID'] ?>">Login</a> or <a class="green" href="register.php?gameID=<?php echo $_GET['gameID'] ?>">Register</a></p>
    </div>
    <?php
        }
    ?>
        <div class="comment-inner">
            <div class="commentHeader"><p>Fixes <span class="small">(<?php echo $count['count']; ?>)</span></p></div>
            <?php
            if(isset($_GET['showallfixes'])) { 
                if($_GET['showallfixes'] == 'yes') {
                    include 'comments_fix.php';
            }
            } else {
                include 'comments_top3_fix.php';
            }
            ?>
            <div class="commentHeader"><p>General game comments <span class="small">(<?php echo $count1['count']; ?>)</span></p></div>
            <?php
            if(isset($_GET['showallcomments'])) { 
                if($_GET['showallcomments'] == 'yes') {
                    include 'comments_game.php';
                }
                } else {
                    include 'comments_recent10_game.php'; 
                }
            ?>
        </div>      
    </div>
</div>
<script src="../js/updatethumbs.js" type="text/javascript"></script>
<?php
    include 'footer.php';
?>