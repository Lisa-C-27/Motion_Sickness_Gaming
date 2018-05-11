<?php
    session_start();
//Checks if the user is logged in and the session username is equal to the $_GET username (so that other users cannot access other accounts user page)
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['username'] == $_GET['username']) {
    } else {
        header('Location: index.php');
    }
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>
<div class="content game-page">
    <p>This page is not finished.</p>
    <p>This page will allow users to change their password, and possibly add an avatar or image</p>
    <h2>Hi <?php echo $_GET['username']; ?></h2>
    <h3>Welcome to your account page</h3>
    <?php 
        $getrep = getThumbs($_SESSION['userid']);
    ?>
    <h3>Your Reputation</h3>
    <p>Comments: 
        <?php 
            include 'rep_comments.php';
        ?>
    </p>
    <p>Fixes: 
        <?php 
            include 'rep_fix.php';
        ?>
    </p>
    <form>
        <h4>Need to change password? Enter new password below</h4>
        <label for="password">New Password: </label>
        <input id="password"/>
    </form>
</div>
<?php
    include 'footer.php';
?>