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
    <p>On this page will display all comments/fixes for an individual user and a button to disable this user's account</p>
</div>
<?php
    include 'footer.php';
?>