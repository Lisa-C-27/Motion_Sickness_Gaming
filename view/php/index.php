<?php
//This page not complete. Need to do the following:
//  Finish registration section (will be the same process as                    register.php)
//  Most recently added game and fix needs to be displayed from the             database
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>
<!--
<div id="loader">
<div class="loading"></div>
</div>
<div id="pageloader">
    <div class="loading"></div>
</div>
-->
<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Got motion sickness?</h1>
        <p class="splash-subhead" id="text">
            The community is here to help!
        </p>

        <p>
            <a href="games.php" class="pure-button pure-button-primary">View Game Library</a>
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center">What's this site all about?</h2>
        <div class="pure-g">
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fas fa-plus-square"></i>
                    Add games to the library
                </h3>
                <p>
                    If there is a game that is not in our library that gives you motion sickness, add it and the community can hopefully help find a fix for you.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fas fa-wrench"></i>
                    Know an in-game fix?
                </h3>
                <p>
                    If you have found how to fix a certain games 'ability' to give you or others motion sickness, add a fix to help out the community
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fas fa-check"></i>
                    Voting
                </h3>
                <p>
                    Vote as to whether a particular game gives you motion sickness, vote if a certain fix helped you, and vote on other member's comments.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fas fa-star"></i>
                    Reputation
                </h3>
                <p>
                    Everyone can vote on a fix that you added, and even on your comments. The more up votes you get the higher your reputation gets. View the about page for more details.
                </p>
            </div>
        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <img width="300" alt="File Icons" class="pure-img-responsive" src= "../img/arrows.png">
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">
            <h2 class="content-head content-head-ribbon">Most recently added game</h2>
            <?php 
            $getgame = mostRecentGame();
            $getfix = mostRecentFix();
            ?>
            <a class="index" href="individual_games.php?gameID=<?php echo $getgame['gameID']; ?>">
                <?php 
                echo $getgame['gameName'];
            ?>
            </a>
            <h2 class="content-head content-head-ribbon">Most recently added fix</h2>
            <a class="index" href="individual_games.php?gameID=<?php echo $getfix['gameID']; ?>">
                <?php 
                    echo $getfix['gameName'];
                ?>
            </a>
        </div>
    </div>
    <div class="content">
        <h2 class="content-head is-center">Be a part of the community</h2>
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
                <form class="pure-form pure-form-stacked" method="post" action="../../controller/registration_process.php" name="registration">
                    <label for="username">Username</label>
                    <input id="username" type="text" placeholder="Username" name="username" onchange="checkuser();" pattern="[a-zA-Z0-9_]{5,30}">
                    <div id="error_register_user" class="red"></div>
                    <div id="username_status"></div>
                    <label for="password">Password</label>
                    <input id="password" type="password" placeholder="Password" name="userpass" pattern=".{7,30}" onchange="validateForm();">
                    <div id="error_register_pass" class="red"></div>
                    <button type="submit" class="pure-button" name="registration_form">Register</button>
                    <?php
                        include 'error_section.php';
                    ?>
                </form>
            </div>
            <div class="l-box-lrg pure-u-1 pure-u-md-3-5">
                <h4>Register</h4>
                <p>
                    Register an account to add games to the library, add fixes and comments and be a part of the community.
                </p>

                <h4>More Information</h4>
                <p>
                    For more information about this site, visit the about page.
                </p>
            </div>
        </div>

    </div>
    <?php
        include 'footer.php';
    ?>
