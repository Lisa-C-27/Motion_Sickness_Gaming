<?php
    session_start();
    include 'header.php';
    include 'nav.php';
    include '../../model/connect.php';
    include '../../model/dbfunctions.php';
?>
<div class="container page">
    <div class="blog_outer">
        <div class="blog_titles">
            <h1>Motion Sickness Gaming Blog</h1>
            <?php  
                $blog = get_blog($_GET['blogID']);
            ?>
            <h2><?php echo $blog['blogTitle']; ?></h2>
        </div>
        <div class="blog_image">
            <img src="../img/happy_sun.png" width="130px" height="130px"/>
        </div>
    </div>
    <p class="blog_date">
        <?php 
            $phpdate = strtotime( $blog['datetime'] );
            $mysqldate = date( 'd F Y', $phpdate );
            echo $mysqldate
        ?>
    </p>
    <p class="blog">
        <?php echo $blog['blog']; ?>
    </p>
    <p class="author">
        <?php echo $blog['username']; ?>
    </p>
    <p class="signature">Motion Sickness Gaming</p>
    <a href="blogs.php">&lArr; Back to blog list</a>
    <?php 
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
    ?>
    <div id="comment_blog">
        <form class="pure-form pure-form-stacked" id="blogComment" method="post" action="../../controller/addcomment.php">
            <fieldset>
                <p class="nomargin">Add a comment:</p>
                <textarea name="blogcomment" class="comment" id="blogcomment" onchange="validateForm();"></textarea>
                <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                <input type="hidden" name="blogID" value="<?php echo $_GET['blogID'] ?>"/>
                <input type="hidden" name="action_type" value="addblogcomment"/>
                <button type="submit" class="pure-button pure-button-primary">Comment</button>
            </fieldset>
            <?php
                include 'error_section.php';
            ?>            
            <div id="gamecomment_error"></div>
        </form>
    </div>
    <?php
    } else {
    ?>
    <p>To add a comment, please <a href="login.php?blogID=<?php echo $_GET['blogID'] ?>">Login</a> or <a href="register.php?blogID=<?php echo $_GET['blogID'] ?>">Register</a>.</p>
    <?php
    }
    $count = getBlogCommCount($_GET['blogID']);
    ?>
    <div class="comment-inner">
        <div class="commentHeader">
            <p>Comments <span class="small">(<?php echo $count['count']; ?>)</span></p>
        </div>
<?php
        include 'blog_comments.php';
?>
    </div>
</div>
<?php
    include 'footer.php';
?>