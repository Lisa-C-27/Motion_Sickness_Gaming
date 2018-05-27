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
    <h1>User details page</h1>
    <?php
        $getuser = getOneUser($_GET['userID']);
    ?>
    <h2>Username: <?php echo $getuser['username']; ?></h2>
    <?php
        if ($getuser['acctStatus'] == '1') {
    ?> 
    <a class="status" href="#" onclick="changestatus('disable', <?php echo $_GET['userID']; ?>)">Disable</a>
    <a class="status" href="#" onclick="changestatus('admin', <?php echo $_GET['userID']; ?>)">Make admin</a>
    <?php
        } else if ($getuser['acctStatus'] == '2') {
    ?>
    <a class="status" href="#" onclick="changestatus('active', <?php echo $_GET['userID']; ?>)">Enable</a>
    <?php
        } else if ($getuser['acctStatus'] == '3') {
    ?>
    <a class="status" href="#" onclick="changestatus('disable', <?php echo $_GET['userID']; ?>)">Disable</a>
    <a class="status" href="#" onclick="changestatus('removeadmin', <?php echo $_GET['userID']; ?>)">Remove admin</a>
    <?php
        }
    ?>
    
    <h2>All comments/replies/fixes made by user</h2>
  
    <?php
        include 'admin_view_user_fix.php';
        include 'admin_view_user_fixcomm.php';
        include 'admin_view_user_fixreply.php';
        include 'admin_view_user_gamecomm.php';
        include 'admin_view_user_gamereply.php';
    ?>
</div>
<script src="../js/admin.js" type="text/javascript"></script>
<?php
    include 'footer.php';
?>