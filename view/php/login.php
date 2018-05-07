<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<!--
<div id="loader">
<div class="loading"></div>
</div>
<div id="pageloader">
    <div class="loading"></div>
</div>
-->
<div class="content-center">
    <form class="pure-form pure-form-stacked" method="post" action="../../controller/login_process.php">
        <fieldset>
            <legend>Sign In</legend>
            <label for="username">Username</label>
            <input id="username" type="text" placeholder="Username" name="username" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
            <label for="remember" class="pure-checkbox">
                <input id="remember" type="checkbox" name="remember"> Remember me
            </label>
            <button type="submit" class="pure-button pure-button-primary" name="login">Sign in</button>
            <div id='errorsection'> 
                
                <?php
                    //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
                    if (!isset($_SESSION['message'])){
                        $_SESSION['message'] = "";
                    }  
                    echo $_SESSION['message'];       
                    unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
                ?>
            </div>
        </fieldset>
    </form>
</div>
<?php
    include 'footer.php';
?>

