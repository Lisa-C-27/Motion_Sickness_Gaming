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
?>
<?php
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
        // This checks if the user is logged in. If true then the Add Fix button will be displayed
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
        ?>
        <button type="button" class="pure-button inline" data-toggle="modal" data-target="#myModal">Add a fix</button>
        <?php
            };
        ?>
    </div>
    <!-- Add Fix Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add a possible fix for this game</h4>
                </div>
                <div class="modal-body">
                    <form class="pure-form pure-form-stacked">
                        <p>Add as much detail as possible</p>
                        <fieldset>
                            <textarea id="fix" rows="10" cols="50">
                            </textarea>
                            <button type="submit" class="pure-button pure-button-primary">Add fix</button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </div>
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
        <div class="pure-button-group" role="group" aria-label="...">
            <button class="tab" onclick="tabOne();">Game Comments</button>
            <button class="tab" onclick="tabTwo();">Fixes and comments</button>
        </div>
        <div class="comment-inner">
            <div id="gamecomment">
                <?php
                $getcomments = getGameComments($_GET['gameID']);
                
                foreach($getcomments as $row) {
                   
                    echo
                '<div class="databaseComments">';
                    echo
                    '<div class="userinfo">';
                    echo
                        '<p>' . $row['username'] . '</p>';
                    
                   $getrep = getThumbs($row['userID']);
                    
//                    print_r($getrep); //For debugging
                    ?>
                
                    <script>
                    var first = parseInt(<?php echo $getrep['commthumbs']; ?>);
                    var second = parseInt(<?php echo $getrep['fixthumbs']; ?>);
                    
                        
                    window.onload = function() {
                
                        //For debugging
                            console.log(first);
                            console.log(second);
                        
                    
                    
                    if (first <= 50) {
                    document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "Newbie";
                    } else if (first > 50 && a <= 100) {
                    document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "Community";
                    } else {
                        document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "The Best";
                    }
                    if (second <= 50) {
                    document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Newbie fixer";
                    } else if (second > 50 && a <= 100) {
                    document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Community Fixer";
                    } else {
                        document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Best Fixer";
                    }
                        }
                         
                    </script>
                <?php
//                    print_r($getrep);
//                    foreach($getrep as $new) {
//                        echo '<form id="' . $new['username'] . '_thumbcount">';
//                        echo '<input type="hidden" name="commthumbs" value="' . $new['commthumbs'] . '">';
//                        echo '<input type="hidden" name="fixthumbs" value="' . $new['fixthumbs'] . '">';
//                        echo '</form>';
//                    }
                    echo
                        '<p id="' . $getrep['username'] . '_comm"></p>';
                    echo
                        '<p id="' . $getrep['username'] . '_fix"></p>';
                    echo
                        '<p>' . $row['gameCommDateTime'] . '</p>';
                    echo
                    '</div>';
                    echo
                    '<div class="actualcomment">' . $row['gameComment'] . '</div>';
                    echo
                    '<div class="vote">';
                    echo
                        '<i class="fas fa-thumbs-up"></i>';
                    echo
                        '<span>' . $row['gameCommThUp'] . '</span>';
                    echo
                        '<i class="fas fa-thumbs-down"></i>';
                    echo
                        '<span>' . $row['gameCommThDown'] . '</span>';
                    echo
                    '</div>';
                    echo
                    '<div class="reply">';
                    echo
                        '<a href="#">Reply</a>';
                    echo
                    '</div>';
//                    echo
//                    '<div class="userinfo">';
//                    $getreply = getGameReply($row['gameCommID']);
//                    foreach($getreply as $row2) {
//                    echo
//                        '<p>' . $row2['username'] . '</p>';
//                    echo
//                        '<p id="' . $getrep['username'] . '_comm"></p>';
//                    echo
//                        '<p id="' . $getrep['username'] . '_fix"></p>';
//                    echo
//                        '<p>' . $row2['replyCommDateTime'] . '</p>';
//                    echo
//                    '</div>';
//                    echo
//                    '<div class="actualcomment">' . $row['gameComment'] . '</div>';
//                    echo
//                    '<div class="vote">';
//                    echo
//                        '<i class="fas fa-thumbs-up"></i>';
//                    echo
//                        '<span>' . $row2['replyCommThUp'] . '</span>';
//                    echo
//                        '<i class="fas fa-thumbs-down"></i>';
//                    echo
//                        '<span>' . $row2['replyCommThDown'] . '</span>';
//                    echo
//                    '</div>';
//                    }
                    echo
                '</div>';
                }
                ?>
            </div>
            
            <div id="fixcomment">
                <div class="databaseComments">
                    <div class="userinfo">
                        <p>username</p>
                        <p>rep</p>
                        <p>Date/time</p>
                    </div>
                    <div class="actualcomment">Users fixes go here - need to ensure highest rated fix is at the top
                    </div>
                    <div class="vote">
                        <i class="fas fa-thumbs-up"></i>
                        <span>20</span>
                        <i class="fas fa-thumbs-down"></i>
                        <span>5</span>
                    </div>
                    <div class="reply">
                        <a href="#">Reply</a>
                    </div>        
                    <div class="userinfo2">
                        <p>username</p>
                        <p>rep</p>
                        <p>Date/time</p>
                    </div>
                    <div class="actualcomment2">Users fix reply comment from database goes here
                    </div>
                    <div class="vote2">
                        <i class="fas fa-thumbs-up"></i>
                        <span>20</span>
                        <i class="fas fa-thumbs-down"></i>
                        <span>5</span>
                    </div>
                    <div class="reply2">
                        <a href="#">Reply</a>
                    </div>        
                </div>
            </div>
            
            <div class="addcomment">
                <form class="pure-form pure-form-stacked">
                    <fieldset>
                        <textarea id="gamecomment" rows="3" cols="60"></textarea>
                        <button type="submit" class="pure-button pure-button-primary">Comment</button>
                    </fieldset> 
                </form>
            </div>
            
        </div>
    </div>
</div>
<script>

</script>
<?php
    include 'footer.php';
?>