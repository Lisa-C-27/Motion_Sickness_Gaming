<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
?>
<div class="content-center">
    
    <form class="pure-form pure-form-stacked" method="POST" action="../../controller/registration_process.php" name="registration">
        <legend>Register</legend>
        <label for="username">Username</label>
        <input id="username" type="text" placeholder="Username" name="username" onchange="checkuser();" pattern="[a-zA-Z0-9_]{5,30}">
        <div id="error_register_user" class="red"></div>
        <div id="username_status"></div>
<!--        checkuser() function is located in js/script.js-->
        <label for="password">Password</label>
        <input id="password" type="password" placeholder="Password" name="userpass" pattern=".{7,30}" onchange="validateForm();"> 
        <div id="error_register_pass" class="red"></div>
<!--
        <label for="date">Birth Date</label>
        <input placeholder="Date of Birth" type="text" id="date"/>
-->
        <?php
            if(isset($_GET['gameID'])) { 
        ?>
        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID']; ?>"/>
        <?php
            }
        ?>
        <button type="submit" class="pure-button pure-button-primary" name="registration_form">Register</button>
        <?php
            include 'error_section.php';
        ?>
    </form>
<!--The datepicker-->
<!--
<script>
    $(document).ready(function() {
        const picker = datepicker('#date');
    });
</script>
<script src="https://unpkg.com/js-datepicker@2.3.2/datepicker.min.js"></script>
-->
</div>
<?php
    include 'footer.php';
?>