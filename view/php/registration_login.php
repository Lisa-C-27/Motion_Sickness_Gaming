<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<div class="content-center">
    <form class="pure-form pure-form-stacked" method="post" action="../../controller/login_process.php">
        <fieldset>
            <legend>
                <p>Username created</p>
                <p>Please sign in</p>
            </legend>
            <label for="username">Username</label>
            <input id="username" type="text" placeholder="Username" name="username">
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name="password">
            <label for="remember" class="pure-checkbox">
                <input id="remember" type="checkbox"> Remember me
            </label>
            <button type="submit" class="pure-button pure-button-primary" name="login">Sign in</button>
            <div id='errorsection'> 
                <?php
                    //if $_SESSION['error'] is not set then set it as nothing to eliminate an undeclared variable error
                    if (!isset($_SESSION['error'])){
                        $_SESSION['error'] = "";
                    }  
                    echo $_SESSION['error'];       
                    unset ($_SESSION['error']); //this line clears what is set in the session variable['error']
                ?>
            </div>
        </fieldset>
    </form>
</div>
<?php
    include 'footer.php';
?>