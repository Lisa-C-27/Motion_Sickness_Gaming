<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<div class="content-center">
    <form class="pure-form pure-form-stacked" method="post" action="../../controller/login_process.php" id="login">
        <fieldset>
            <legend>Sign In</legend>
            <label for="username">Username</label>
            <input id="username" type="text" placeholder="Username" name="username">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name="password">
            <label for="remember" class="pure-checkbox">
                <input id="remember" type="checkbox" name="remember"> Remember me
            </label>
            <?php
                if(isset($_GET['gameID'])) { 
            ?>
            <input type="hidden" name="gameID" value="<?php echo $_GET['gameID']; ?>"/>
            <?php
                }
            ?>
            <div>
                <a href="forgot_password.php">Forgot password?</a>
            </div>
            <button type="submit" class="pure-button pure-button-primary" name="login">Sign in</button>
        <?php
            include 'error_section.php';
        ?>
        </fieldset>
    </form>
</div>
<script>

</script>
<?php
    include 'footer.php';
?>

