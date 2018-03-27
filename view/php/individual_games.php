<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>
<?php
    $gamedetails = get_one_game($_GET['gameID']);
?>
<script>
    var x = parseInt(<?php echo $gamedetails['gameThUp']; ?>);
    var y = parseInt(<?php echo $gamedetails['gameThDown']; ?>);
</script>
<div class="container game-page"> 
    <div class="game-button">
        <h1 class="inline"><?php echo $gamedetails['gameName'];?></h1>
        <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
        ?>
        <button type="button" class="pure-button inline" data-toggle="modal" data-target="#myModal">Add a fix</button>
        <?php
            };
        ?>
    </div>
    <!-- Modal -->
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
            <button id="game_yes" class="pure-button thumbs" onclick="updatethumbsup(<?php echo $_GET['gameID']; ?>)">
                Yes <i class="fas fa-thumbs-up"></i>
            </button>
            <span id="thup"><?php echo $gamedetails['gameThUp'];?></span>    
            <button id="game_no" class="pure-button thumbs" onclick="updatethumbsdown(<?php echo $_GET['gameID']; ?>)">
                No <i class="fas fa-thumbs-down"></i>
            </button>
            <span id="thdown"><?php echo $gamedetails['gameThDown'];?></span>
        </span>
    </div>
    
    <div class="comment-container">
        <div class="pure-button-group" role="group" aria-label="...">
            <button class="tab" onclick="tabOne()">Game Comments</button>
            <button class="tab" onclick="tabTwo()">Fixes and comments</button>
        </div>
        <div class="comment-inner">
            <div id="gamecomment">
                <div class="databaseComments">
                    <div class="userinfo">
                        <p>username</p>
                        <p>rep</p>
                        <p>Date/time</p>
                    </div>
                    <div class="actualcomment">Users comment from database goes here
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
                    <div class="actualcomment2">Users reply comment from database goes here
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
                <div class="addcomment">
                    <form class="pure-form pure-form-stacked">
                        <fieldset>
                            <textarea id="gamecomment" rows="3" cols="60"></textarea>
                            <button type="submit" class="pure-button pure-button-primary">Comment</button>
                        </fieldset> 
                    </form>
                </div>
            </div>
            <div id="fixcomment">
                Fix comments
            </div>
        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>