<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Got motion sickness?</h1>
        <p class="splash-subhead">
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
            <img width="300" alt="File Icons" class="pure-img-responsive" src= "css/layouts/img/arrows.png">
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">
            <h2 class="content-head content-head-ribbon">Most recently added game</h2>
            <a href="#">
                Name of game will go here
            </a>
            <h2 class="content-head content-head-ribbon">Most recently added fix</h2>
            <a href="#">
                Details of this fix will go here
            </a>
        </div>
    </div>
    <div class="content">
        <h2 class="content-head is-center">Be a part of the community</h2>
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
                <form class="pure-form pure-form-stacked" method="post" action="../../controller/registration_process.php" onsubmit="checkall();">
                    <fieldset>
                        <label for="username_reg">Username</label>
                        <input id="username_reg" type="text" placeholder="Username" name="username">
                        <label for="password">Password</label>
                        <input id="password" type="password" placeholder="Password" name="password">
                        <button type="submit" class="pure-button" name="registration">Register</button>
                    </fieldset>
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
