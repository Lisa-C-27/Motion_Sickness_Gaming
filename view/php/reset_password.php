<?php
//Need to hash the password before database insertion
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<div class="container page">
<?php
    $hashed = $_GET['recover'];
    if(isset($_GET['recover'])) {
        include '../../controller/recover_password.php';
        if (strtotime($date) >= (time() + 86400) || $expired == 1 ){
?>
    <h1>Password Reset Page</h1>
    <p>This password recovery link has expired</p>
<?php
        } else {
?>
    <h1>Password Reset Page</h1>
    <p>Please enter a new password for your account</p>
    <form method="post" action="../../controller/update_password.php">
        <fieldset>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password"/>
            <input type="hidden" name="userID" value="<?php echo $userID?>">
            <button type="submit" name="pwreset">Submit</button>
        </fieldset>
    </form>
<?php
    include 'error_section.php';
        }
    }
?>
</div>