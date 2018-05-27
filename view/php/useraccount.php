<?php
    session_start();
//Checks if the user is logged in and the session username is equal to the $_GET username (so that other users cannot access other accounts user page)
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['username'] == $_GET['username']) {
    } else {
        header('Location: index.php');
    }
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
    if(isset($_GET['pw']) && $_GET['pw'] == 'update') {
?>
    <script>
        window.onload = function() {
        $("select").imagepicker();
        $("#show").click();
        }
    </script>
<?php
    } else {
?>
    <script>
        window.onload = function() {
            $("select").imagepicker();
        }    
    </script>
<?php
    }
?>
<div class="content game-page">
    <h1>Hi <?php echo $_SESSION['username']; ?></h1>
    <h2>Welcome to your account page</h2>
    <?php
        $getuser = getOneUser($_SESSION['userid']); 
    ?>
    <div id="upper-profile">
        <div id="avatar-profile-container">
            <img class="avatar-profile" src="<?php echo $getuser['url']; ?>"/>
            <div id="button">
                <button type="button" class="avatar-button" onclick="selectAvatar();" id="showAvatars">Change Avatar</button>
            </div>
        </div>
        <div id="reputation">
            <?php 
                $getrep = getThumbs($_SESSION['userid']);
            ?>
            <h3>Reputation</h3>
            <p><strong>Comments: </strong>
                <?php 
                    include 'rep_comments.php';
                ?>
            </p>
            <p><strong>Fixes: </strong>
                <?php 
                    include 'rep_fix.php';
                ?>
            </p>
        </div>
    </div>
    <div id="newAvatar">
        <p>Select from the following avatars:</p>
        <form method="post" action="../../controller/avatar.php">
            <select name="avatarID" class="image-picker show-html">
                <option data-img-src="../img/avatars/unknown.png" data-img-class="first" data-img-alt="unknown" value="1">Unknown</option>
                <option data-img-src="../img/avatars/amazed.png" data-img-alt="amazed" value="2">Amazed</option>
                <option data-img-src="../img/avatars/avatar.png" data-img-alt="avatar" value="3">Avatar</option>
                <option data-img-src="../img/avatars/bluey.png" data-img-alt="bluey" value="4">Bluey</option>
                <option data-img-src="../img/avatars/control.png" data-img-alt="control" value="5">Control</option>
                <option data-img-src="../img/avatars/cool.png" data-img-alt="cool" value="6">Cool</option>
                <option data-img-src="../img/avatars/dude.png" data-img-alt="dude" value="7">Dude</option>
                <option data-img-src="../img/avatars/evil.png" data-img-alt="evil" value="8">Evil</option>
                <option data-img-src="../img/avatars/orc.png" data-img-alt="orc" value="9">Orc</option>
                <option data-img-src="../img/avatars/panda.png" data-img-alt="panda" value="10">Panda</option>
                <option data-img-src="../img/avatars/penguin.png" data-img-alt="penguin" value="11">Penguin</option>
                <option data-img-src="../img/avatars/sidedude.png" data-img-alt="sidedude" value="12">Sidedude</option>
                <option data-img-src="../img/avatars/smiley.png" data-img-alt="smiley" value="13">Smiley</option>
                <option data-img-src="../img/avatars/vampire.png" data-img-alt="vampire" data-img-class="last" value="14">Vampire</option>
            </select>
            <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
            <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>"/>
            <button type="submit" class="pure-button" >Submit</button>
        </form>
    </div>
    
    <h3>Need to change your password?</h3>
    <button type="button" id="show" onclick="show_changepw();" class="avatar-button">Change Password</button>
    <div id="changepw">
        <form class="pure-form pure-form-aligned" method="post" action="../../controller/change_password.php">
            <fieldset>
                <div class="pure-control-group">
<!--                    <label for="oldpassword">Current Password: </label>-->
                    <input type="password" id="oldpassword" name="password" class="change_pw" placeholder="Current password"/>
                </div>
                <div class="pure-control-group">
<!--                    <label for="password">New Password: </label>-->
                    <input type="password" id="password" name="newpassword" pattern=".{7,30}" onchange="validateForm();" class="change_pw" placeholder="New password"/>
                    <div id="error_register_pass" class="red"></div>
                </div>
                <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>"/>
                    <button type="submit" class="pure-button" >Submit</button>
                <?php
                    include 'error_section.php';
                ?>
            </fieldset>
        </form>
    </div>
</div>

<?php
    include 'footer.php';
?>