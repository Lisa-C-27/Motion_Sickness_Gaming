<?php
    session_start();
    include 'header.php';
    include 'nav.php';
?>
<div class="container page">
    <h1>Password Recovery</h1>
    <p>To recover your password, please enter you email address</p>
    <div class="recover-form">
        <form class="pure-form pure-form-stacked" method="post" action="../../controller/password_recovery.php">
            <fieldset>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email"/>
                <button class="pure-button pure-button-primary" type="submit" name="pwrec">Submit</button>
            </fieldset>
        </form>
        <div> 
            <?php
            //if $_SESSION['message'] is not set then set it as nothing to eliminate an undeclared variable error
                if (!isset($_SESSION['message'])){
                    $_SESSION['message'] = "";
                }
                echo $_SESSION['message'];       
                unset ($_SESSION['message']); //this line clears what is set in the session variable['message']
            ?>
        </div>
    </div>
</div>
<?php
    include 'footer.php';
?>