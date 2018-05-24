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
?>
<div class="content game-page">
    <p>This page is not finished.</p>
    <p>This page will allow users to change their password, and possibly add an avatar or image</p>
    <h2>Hi <?php echo $_SESSION['username']; ?></h2>
    <h3>Welcome to your account page</h3>
    <?php
        $getuser = getOneUser($_SESSION['userid']); 
    ?>
    <div id="avatar-profile-container">
        <img class="avatar-profile" src="<?php echo $getuser['url']; ?>"/>
        <div id="button">
            <button type="button" class="avatar-button" onclick="selectAvatar();" id="showAvatars">Change Avatar</button>
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
            <button type="submit" class="avatar-button" >Submit</button>
        </form>
    </div>
    <?php 
        $getrep = getThumbs($_SESSION['userid']);
    ?>
    <h3>Your Reputation</h3>
    <p>Comments: 
        <?php 
            include 'rep_comments.php';
        ?>
    </p>
    <p>Fixes: 
        <?php 
            include 'rep_fix.php';
        ?>
    </p>
    <form>
        <h4>Need to change password? Enter new password below</h4>
        <label for="password">New Password: </label>
        <input id="password"/>
    </form>
</div>
<script>$("select").imagepicker();</script>
<?php
    include 'footer.php';
?>