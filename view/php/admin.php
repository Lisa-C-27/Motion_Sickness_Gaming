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
    <p>This page is for admin access only.</p>
    <p>Admin will be able to:</p>
        <ul>
            <li><p>View all comments (perhaps with last 24hr/48hr/7days links to breakdown into more manageable comment sections) with the possibility to 'delete' (possibly won't delete from database, but add a column that says deleted and then use an if statement to change the deleted comments to display 'this comment has been deleted')</p></li>
            <li><p>View all users with the possibility to 'disable' accounts (and if I figure it out, 'search' users to make it easier to disable accounts)</p></li>
            <li><p>View total number of comments</p></li>
            <li><p>View total number of users</p></li>
            <li><p>View total number of games</p></li>
            <li><p>View total number of fixes</p></li>
        </ul>
    
    
</div>
<?php
    include 'footer.php';
?>