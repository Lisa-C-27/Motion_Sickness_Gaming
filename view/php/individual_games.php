<?php
//  This page is incomplete. Still need to do the following:
//  'Fix' thumbs up/down reading from database and updating database 
//  Comments thumbs up/down both 'game' and 'game fix' reading from             database and updating database 

    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
//This checks if a user has added a new fix, and if it does makes tabtwo display (fixes and comments tab)
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
    <?php
        include 'game_vote.php';
    ?>

    <div class="comment-container">

        
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