<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';

    if(isset($_GET['addfail']) && $_GET['addfail'] == 'true') {
?>
        <script>
            $(function() {
                document.getElementById('modal').click();
            });
        </script>
    <?php
    }
    ?>
<div class="container page">
    <div class="game-button"> 
        <h1>Games Library</h1>  
        <?php 
        // This checks if the user is logged in. If true then the Add Game button will be displayed
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
        ?>   
        <button type="button" class="pure-button" data-toggle="modal" data-target="#myModal2" id="modal">Add a game</button> 
        <?php
            }; ?>
    </div>
  <!-- Add Game Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">     
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add a game to the library</h4>
                </div>
                <div class="modal-body">
                    <form class="pure-form pure-form-stacked" method="post" action="../../controller/insertgame.php">
                        <fieldset>
                            <p>Before adding a game, please check that it isn't already in the library</p>
                            <label for="gamename">Name of game </label>
                            <input id="gamename" type="text" placeholder="Type name of game here" name="gameName" onchange="checkgame();">
                            <!-- checkgame() function is located in js/script.js file -->
                            <div id="game_status"></div>
                            <button type="submit" class="pure-button pure-button-primary" name="submit_game">Add game</button>
                        </fieldset>
                        <div class="games_message"> 
                            <?php
                                //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
                                if (!isset($_SESSION['message'])){
                                    $_SESSION['message'] = "";
                                }
                                echo $_SESSION['message'];       
//                                unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
                            ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </div>
    </div> 
    <div class="library_info">
        <h4>Click on a game to see comments and fixes about that game.</h4>
        <h5>If you don't see a game in the list that gives you motion sickness, add it so that others can help you find a fix.</h5>
    </div>
    <div class="games_message"> 
        <?php
            //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
            if (!isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            echo $_SESSION['message'];       
            unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
        ?>
    </div>
<!--    <h2><a href="#">A</a>|<a href="#">B</a>|<a href="#">C</a>|<a href="#">D</a>|<a href="#">E</a>|<a href="#">F</a>|<a href="#">G</a>|<a href="#">H</a>|<a href="#">I</a>|<a href="#">J</a>|<a href="#">K</a>|<a href="#">L</a>|<a href="#">M</a>|<a href="#">N</a>|<a href="#">O</a>|<a href="#">P</a>|<a href="#">Q</a>|<a href="#">R</a>|<a href="#">S</a>|<a href="#">T</a>|<a href="#">U</a>|<a href="#">V</a>|<a href="#">W</a>|<a href="#">X</a>|<a href="#">Y</a>|<a href="#">Z</a></h2>-->
<!-- 
Would like headings of A,B,C etc with the relevant games within each div
    <ul>
        <div id="agames">
            <h3>A</h3>
            <li><a href="individual_games.php">Game beginning with A</a></li>
            <li><a href="#">Game beginning with A</a></li>
            <li><a href="#">Game beginning with A</a></li>
        </div>
        <div id="bgames">
            <h3>B</h3>
            <li><a href="#">Game beginning with B</a></li>
            <li><a href="#">Game beginning with B</a></li>
            <li><a href="#">Game beginning with B</a></li>
        </div>
    </ul>
-->
            <?php 
                $getgame = mostRecentGame();
                $getfix = mostRecentFix();
                $getblog = mostRecentBlog();
                $blogurl = get_blogurl($getblog['blogID']);
                $gameurl = gamelisturl($getgame['gameID']);
                $fixurl = gamelisturl($getfix['gameID']);
            ?>
    <div class="recent">
        <p>Most recently added game: 
        <a class="index" href="individual_games.php?gameID=<?php echo $getgame['gameID']; ?>&game=<?php echo $gameurl['gameName']; ?>">
            <?php 
            echo $getgame['gameName'];
        ?>
        </a></p>
        <p>Most recently added fix: 
        <a class="index" href="individual_games.php?gameID=<?php echo $getfix['gameID']; ?>&game=<?php echo $fixurl['gameName']; ?>&fix=tab">
            <?php 
                echo $getfix['gameName'];
            ?>
        </a></p>
    </div>
    <ul id="gamelist">
        <?php
            $allgames = gamelist(); //This function is located in model/dbfunctions.php

            foreach($allgames as $row) {
                $count = getFixCount($row['gameID']);
                $count1 = allCommentsReplies($row['gameID']);
                $date = activityDate($row['gameID']);
                
                $phpdate = strtotime( $date['date'] );
                $mysqldate = date( 'd F Y', $phpdate );
                $url = gamelisturl($row['gameID']);
                echo '<a class="gameurl" id="urlname_' . $row['gameID'] . '" href="individual_games.php?gameID='. $row['gameID'] . '&game='. $url['gameName'] . '">
                <div class="gameforum">
                <div class="gamename">' . $row['gameName'] . '
                </div>
                <div class="fixcount">Fixes: (' . $count['count'] . ')</div> <div class="commcount">Comments/Replies: (' . $count1['newcount'] . ')</div> 
                <div class="activity">Last activity: ';
                if(!empty($date['date'])) {
                    echo $mysqldate;
                } else {
                    echo '-- --- ----';
                }
                echo '  
                </div>
                </div>
                </a>';
            }
        ?>
    </ul>
</div>
<?php
    include 'footer.php';
?>