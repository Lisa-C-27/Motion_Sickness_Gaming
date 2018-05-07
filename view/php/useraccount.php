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
    <p>This page will allow users to change their password, and possibly add an avatar or image</p>
</div>
<?php
    include 'footer.php';
?>