<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Motion Sickness Gaming</a>
        <ul class="pure-menu-list">
            <li class="pure-menu-item pure-menu-selected">
                <a href="index.php" class="pure-menu-link">Home</a>
            </li>
            <li class="pure-menu-item">
                <a href="games.php" class="pure-menu-link">Games</a>
            </li>
            <li class="pure-menu-item">
                <a href="about.php" class="pure-menu-link">About</a>
            </li>
            <li class="pure-menu-item">
                <a href="contact.php" class="pure-menu-link">Contact</a>
            </li>
            <!--  If user is logged in display Welcome,username and Logout -->
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>     
            <li class="pure-menu-item">
                <a class="pure-menu-link" id="welcome">Welcome, <?php echo $_SESSION['username'];?></a>
            </li>
            <li class="pure-menu-item">
                <a class="pure-menu-link" href="../../model/logout.php">Logout</a>
            </li>
            <!-- If user is not logged in display Login and Register-->
            <?php } else { ?>
            <li class="pure-menu-item">
                <a href="login.php" class="pure-menu-link">Sign In</a>
            </li>    
            <li class="pure-menu-item">
                <a href="register.php" class="pure-menu-link">Register</a>
            </li>
            <?php }; ?>
        </ul>
    </div>
</div>