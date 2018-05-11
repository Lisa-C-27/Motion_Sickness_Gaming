<?php
    session_start();
//Checks if the user is logged in as admin before loading page, if user is not admin then redirects to index page
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['account'] == 'admin') {
    } else {
        header('Location: index.php');
    }
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>
<div class="content game-page">
        <h1>Admin Panel</h1>
    <p>This page is for admin access only.</p>
    <p>This page is not finished yet</p>
    <p>Admin will be able to:</p>
        <ul>
            <li><p>View all comments (perhaps with last 24hr/48hr/7days links to breakdown into more manageable comment sections) with the possibility to 'delete' (possibly won't delete from database, but add a column that says deleted and then use an if statement to change the deleted comments to display 'this comment has been deleted')</p></li>
            <li><p>View all users with the possibility to 'disable' accounts (and if I figure it out, 'search' users to make it easier to disable accounts)</p></li>
        </ul>
    <div id="stats">
        <h2>Stats</h2>
        <?php 
            $getusers = getUsers();
            $getgames = getGames();
            $getfixes = getFixesNo();
            $getcomms = getComments();
            $getreplies = getReplies();
        ?>
        <p>Total # of users: <?php echo $getusers['users']; ?></p>
        <p>Total # of games: <?php echo $getgames['games']; ?></p>
        <p>Total # of fixes: <?php echo $getfixes['fixes']; ?></p>
        <p>Total # of comments: <?php echo $getcomms['comms']; ?></p>
        <p>Total # of replies: <?php echo $getreplies['replies']; ?></p>
    </div>
<!--    <a href="#viewUsers">-->
        <button onclick="viewuserbutton();" id="view">View all users <i class="fas fa-chevron-down"></i></button>
        <button onclick="hideuserbutton();" id="hide">Hide all users <i class="fas fa-chevron-up"></i></button>
<!--    </a>-->
    <div id="viewUsers">
        <div class="col1">
            <div class="tablehead">
                <h3>Username</h3>
            </div>
            <?php
            $getallusers = getAllUsers();
            foreach($getallusers as $row) {
            ?>
            <p><a href="admin_view_user.php?userID=<?php echo $row['userID'] ?>"><?php echo $row['username'] ?></a></p>
            <?php
            }
            ?>
        </div>
        <div class="col2">
            <div class="tablehead">
                <h3>User Create Date</h3>
            </div>
            <?php
            foreach($getallusers as $row) {
            ?>
                <p><?php echo $row['userCreateDate'] ?></p>
            <?php
            }
            ?>
        </div>
        <div class="col3">
            <div class="tablehead">
                <h3>Account Status</h3>
            </div>
            <?php
            foreach($getallusers as $row) {
            ?>
            <p> <?php 
                if($row['acctStatus'] == 1) {
                    echo 'Active';
                } else if($row['acctStatus'] == 2) {
                    echo 'Disabled';
                } else if ($row['acctStatus'] == 3) {
                    echo 'Admin';
                }
                ?>
            </p>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
    include 'footer.php';
?>