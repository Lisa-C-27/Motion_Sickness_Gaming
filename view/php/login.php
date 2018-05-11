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

<script>
    $(function() {

    if (localStorage.chkbx && localStorage.chkbx != '') {
        $('#remember').attr('checked', 'checked');
        $('#username').val(localStorage.usrname);
        $('#password').val(localStorage.pass);
    } else {
        $('#remember').removeAttr('checked');
        $('#username').val('');
        $('#password').val('');
    }

//    $('#remember').click(function() {
        $('#login').on('submit', function() {
        if ($('#remember').is(':checked')) {
            // save username and password
            localStorage.usrname = $('#username').val();
            localStorage.pass = $('#password').val();
            localStorage.chkbx = $('#remember').val();
        } else {
            localStorage.usrname = '';
            localStorage.pass = '';
            localStorage.chkbx = '';
        }
    });
    });
</script>

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
            <button type="submit" class="pure-button pure-button-primary" name="login">Sign in</button>
        <?php
            include 'error_section.php';
        ?>
        </fieldset>
    </form>
</div>
<?php
    include 'footer.php';
?>

