<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>

<div class="container game-page">
    <div class="game-button"> 
        <h1 class="inline">Games Library</h1>  
        <?php 
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
        ?>   
        <button type="button" class="pure-button inline" data-toggle="modal" data-target="#myModal2">Add a game</button> 
        <?php
            }; ?>
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
                    <form class="pure-form pure-form-stacked" method="post" action="../../controller/insertgame.php">
                        <fieldset>
                            <p>Before adding a game, please check that it isn't already in the library</p>
                            <label for="gamename">Name of game </label>
                            <input id="gamename" type="text" placeholder="Type name of game here" name="gameName" onchange="checkgame();">
                            <div id="game_status"></div>
                            <button type="submit" class="pure-button pure-button-primary" name="submit_game">Add game</button>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>  
        </div>
    </div>  
    <div id='errorsection' class="games_message"> 
        <?php
            //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
            if (!isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            echo $_SESSION['message'];       
            unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
        ?>
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