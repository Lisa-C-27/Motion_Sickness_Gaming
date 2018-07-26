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
</div>
<?php
    include 'footer.php';
?>