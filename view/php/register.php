<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
?>
<div class="content-center">
    <form class="pure-form pure-form-stacked" method="POST" action="../../controller/registration_process.php">
        <legend>Register</legend>
        <label for="usernamereg">Username</label>
        <input id="usernamereg" type="text" placeholder="Username" name="username" onkeyup="checkuser();">
<!--        checkuser() function is located in js/script.js-->
        <label for="password">Password</label>
        <input id="password" type="password" placeholder="Password" name="userpass"> <span id="username_status"></span>
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
        <button type="submit" class="pure-button pure-button-primary" name="registration_form">Register</button>
        
    </form>
</div>
<?php
    include 'footer.php';
?>