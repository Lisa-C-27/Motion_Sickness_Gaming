<?php
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
?>
<div class="content-center">
    <form class="pure-form pure-form-stacked" method="post" action="../../controller/registration_process.php" onsubmit="checkall();">
        <fieldset>
            <legend>Register</legend>
            <label for="username_reg">Username</label>
            <input id="username_reg" type="text" placeholder="Username" name="user_name" onkeyup="checkuser();">
            <span id="username_status"></span>
            <label for="password">Password</label>
            <input id="password" type="password" placeholder="Password" name="user_pass">
            <input type="submit" class="pure-button pure-button-primary" name="registration_form" value="Register">
        </fieldset>
    </form>
</div>
<?php
    include 'footer.php';
?>