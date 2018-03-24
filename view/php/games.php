<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>

<div class="container game-page">
    <h1>Games Library</h1>
    <div class="game-button">  
        <button type="button" class="pure-button pure-button-primary" data-toggle="modal" data-target="#myModal2">Add a game</button>
    </div>
  <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">     
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add a game to the library</h4>
                </div>
                <div class="modal-body">
                    <form class="pure-form pure-form-stacked" method="post" action="../../model/insertgame.php" onsubmit="checkallgame();">
                        <fieldset>
                            <p>Before adding a game, please check that it isn't already in the library</p>
                            <label for="gamename">Name of game </label>
                            <input id="gamename" type="text" placeholder="Type name of game here" name="gameName" onkeyup="checkgame();">
                            <span id="game_status"></span>
                            <input type="submit" class="pure-button pure-button-primary" name="submit_game" value="Add game">
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </div>
    </div>  
    <h2><a href="#">A</a>|<a href="#">B</a>|<a href="#">C</a>|<a href="#">D</a>|<a href="#">E</a>|<a href="#">F</a>|<a href="#">G</a>|<a href="#">H</a>|<a href="#">I</a>|<a href="#">J</a>|<a href="#">K</a>|<a href="#">L</a>|<a href="#">M</a>|<a href="#">N</a>|<a href="#">O</a>|<a href="#">P</a>|<a href="#">Q</a>|<a href="#">R</a>|<a href="#">S</a>|<a href="#">T</a>|<a href="#">U</a>|<a href="#">V</a>|<a href="#">W</a>|<a href="#">X</a>|<a href="#">Y</a>|<a href="#">Z</a></h2>
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
    <ul>
        <?php
            $allgames = gamelist();

            foreach($allgames as $row) {
                echo '<li><a href="individual_games.php?gameID='. $row['gameID'] . '">' . $row['gameName'] . '</a></li>';
        
            }
        ?>
    </ul>
</div>
<?php
    include 'footer.php';
?>