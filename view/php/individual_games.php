<?php
//This page is incomplete. Still need to do the following:
//  Show/Hide needs to work for the game comment / fix comment tabs
//  'Add a fix' inserting to database
//  'Fix' thumbs up/down reading from database and updating database 
//  Comments for both 'game' and 'game fix' reading from the database and       inserting new comments
//  Comments thumbs up/down both 'game' and 'game fix' reading from             database and updating database 
//  Registered users reputation to be calculated based on thumbs up/down
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
//This checks if a user has successfully added a new fix, and if it does makes tabtwo display (fixes and comments tab)
    if(isset($_GET['fix']) && $_GET['fix'] == 'tab') {
?>
        <script>
            $(function() {
                tabTwo();
            });
        </script>
    <?php
    }
//This function is located in 'model/dbfunctions.php'
    $gamedetails = get_one_game($_GET['gameID']);   
    ?>
<script>
    //These variables are used in the functions updatethumbsup() and updatethumbsdown() within 'js/script.js'
    var x = parseInt(<?php echo $gamedetails['gameThUp']; ?>);
    var y = parseInt(<?php echo $gamedetails['gameThDown']; ?>);
</script>
<div class="container game-page"> 
    <div class="game-button">
        <h1 class="inline"><?php echo $gamedetails['gameName'];?></h1>
        <?php
        include 'modal_addfix.php';
        ?>
    </div>
    <div class="gamevote">
        <p>Does this game give you motion sickness?</p>
        <span>
            <button type="button" id="game_yes" class="pure-button thumbs" onclick="updatethumbsup(<?php echo $_GET['gameID']; ?>)">
                Yes <i class="fas fa-thumbs-up"></i>
            </button>
            <span id="thup"><?php echo $gamedetails['gameThUp'];?></span>    
            <button type="button" id="game_no" class="pure-button thumbs" onclick="updatethumbsdown(<?php echo $_GET['gameID']; ?>)">
                No <i class="fas fa-thumbs-down"></i>
            </button>
            <span id="thdown"><?php echo $gamedetails['gameThDown'];?></span>
        </span>
    </div>
    
    <div class="comment-container">
    <div id="errorsection">

        <?php
            //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
            if (!isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            echo $_SESSION['message'];       
            unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
        ?>
    </div>
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
<?php
    include 'footer.php';
?>