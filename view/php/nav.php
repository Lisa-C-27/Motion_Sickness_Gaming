<div class="header">  
    <div class="custom-wrapper pure-g" id="menu">
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu">
                <a href="index.php" class="pure-menu-heading custom-brand">Motion Sickness Gaming</a>
                <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
            </div>
        </div>
        <div class="pure-u-2 pure-u-md-1-3">
            <div class="pure-menu pure-menu-horizontal custom-can-transform">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Home</a></li>
                    <li class="pure-menu-item"><a href="games.php" class="pure-menu-link">Games</a></li>
                    <li class="pure-menu-item"><a href="blogs.php" class="pure-menu-link">Blog</a></li>
                    <li class="pure-menu-item"><a href="about.php" class="pure-menu-link">About</a></li>
                    <li class="pure-menu-item"><a href="contact.php" class="pure-menu-link">Contact</a></li>
                    <!--  If user is logged in display 'your account' -->
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>     
                    <li class="pure-menu-item">
                        <a class="pure-menu-link" href="useraccount.php?username=<?php echo $_SESSION['username'] ?>"><i class="fas fa-user"></i> Your Account</a>
                    </li>
                    <?php }
//            If user logged in is an admin display admin link
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['account'] == 'admin'){ ?>
                    <li class="pure-menu-item">
                        <a href="admin.php" class="pure-menu-link"><i class="fas fa-unlock-alt"></i> Admin</a>
                    </li>
                    <?php }
//            If user is logged in display logout 
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?> 
                    <li class="pure-menu-item">
                        <a class="pure-menu-link" href="../../controller/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
            <!-- If user is not logged in display Login and Register-->
                    <?php } else { 
                        if(isset($_GET['gameID'])) {
                    ?>
                    <li class="pure-menu-item"> 
                        <a href="login.php?gameID=<?php echo $_GET['gameID'] ?>" class="pure-menu-link">Sign In</a>
                    </li>
                    <li class="pure-menu-item">
                        <a href="register.php?gameID=<?php echo $_GET['gameID'] ?>" class="pure-menu-link">Register</a>
                    </li>
                    <?php
                        } else {
                    ?>
                    <li class="pure-menu-item"> <a href="login.php" class="pure-menu-link">Sign In</a></li>    
                    <li class="pure-menu-item"><a href="register.php" class="pure-menu-link">Register</a></li>
                    <?php }}; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="loader">
    <div class="loading"></div>
</div>
<div id="pageloader">
    <div class="loading"></div>
</div>