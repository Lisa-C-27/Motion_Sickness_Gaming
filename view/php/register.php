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
        <input id="username" type="text" placeholder="Username" name="username" onchange="checkuser();" pattern="[a-zA-Z0-9_]{5,30}" <?php if(isset($_GET['username'])) { ?> value="<?php echo $_GET['username'] ?>" <?php
        }?>/>
        <div id="error_register_user" class="red"></div>
        <div id="username_status"></div>
<!--        checkuser() function is located in js/script.js-->
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your Email" onchange="checkemail();" <?php if(isset($_GET['email'])) { echo 'value="'. $_GET['email'] .'"';
        }?>/>
        <div id="email_status"></div>
        <label for="password">Password</label>
        <input id="password" type="password" placeholder="Password" name="userpass" pattern=".{7,30}" onchange="validateForm();"> 
        <div id="error_register_pass" class="red"></div>

        <?php
            if(isset($_GET['gameID'])) { 
        ?>
        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID']; ?>"/>
        <?php
            }
            if(isset($_GET['blogID'])) { 
            ?>
            <input type="hidden" name="blogID" value="<?php echo $_GET['blogID']; ?>"/>
            <?php
                }
            ?>
        <div>
            <input type="checkbox" id="agree" name="agree"/>
            I have read and agree to the <a target="_blank" href="terms_and_conditions.php">Terms and Conditions</a>
        </div>
        <button type="submit" class="pure-button pure-button-primary" name="registration_form">Register</button>
        <?php
            include 'error_section.php';
        ?>
    </form>
</div>
<?php
    include 'footer.php';
?>