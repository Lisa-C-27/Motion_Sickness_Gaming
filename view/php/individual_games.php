<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
//This checks if a user has added a new fix, and if it does makes tabtwo display (fixes and comments tab)
    if(isset($_GET['fix']) && $_GET['fix'] == 'tab') {
?>
        <script>
            window.onload = function() {
                tabTwo();
            }
        </script>
    <?php
    }
//This function is located in 'model/dbfunctions.php'
    $gamedetails = get_one_game($_GET['gameID']);   
    ?>
<div class="container page"> 
    <div class="game-button">
        <h1><?php echo $gamedetails['gameName'];?></h1>
        <?php
            include 'modal_addfix.php';
        ?>
    </div>
    <?php
        include 'game_vote.php';
    ?>

    <div class="comment-container"> 
        <?php
            //If user is logged in then display comment container else display login ore register
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
?>
    <div id="comment_game">
        <form class="pure-form pure-form-stacked" id="gameComment" method="post" action="../../controller/addcomment.php">
            <fieldset>
                <p class="nomargin">Add a comment about the game:</p>
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
    <div id="comment_game">
        <p>To vote, add a fix, comment or reply, please <a class="green" href="login.php?gameID=<?php echo $_GET['gameID'] ?>">Login</a> or <a class="green" href="register.php?gameID=<?php echo $_GET['gameID'] ?>">Register</a></p>
    </div>
    <?php
        }
    ?>
        <div class="pure-button-group tabs" role="group" aria-label="...">
            <button class="tab" onclick="tabOne();" id="tabone">Game Comments</button>
            <button class="tab" onclick="tabTwo();" id="tabtwo">Fixes and comments</button>
        </div>
        <div class="comment-inner">
            <?php
                include 'comments_game.php';
                include 'comments_fix.php';
            ?>     
        </div>      
    </div>
</div>
<script src="../js/updatethumbs.js" type="text/javascript"></script>
<?php
    include 'footer.php';
?>