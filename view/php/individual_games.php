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
<div class="container game-page">
    <h1><?php echo $gamedetails['gameName'];?></h1>
    <div class="gamevote">
        <p>Does this game give you motion sickness?</p>
        <!--        
        Need to finish the onclick functions for adding +1 to thumbsup and thumbsdown using ajax
        -->
        <span>
            <button id="yes" onclick="thumbsup($_GET['gameID'])">
                Yes <i class="fas fa-thumbs-up"></i>
            </button>
            <?php echo $gamedetails['gameThUp'];?> | 
            <button id="no" onclick="thumbsdown($_GET['gameID'])">
                No <i class="fas fa-thumbs-down"></i>
            </button>
            <?php echo $gamedetails['gameThDown'];?>
        </span>
    </div>
    <div class="game-button"> 
        <button type="button" class="pure-button pure-button-primary" data-toggle="modal" data-target="#myModal">Add a fix</button>
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
                            <textarea id="fix" rows="10" cols="60">
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