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
            <h3>Click on a blog to read</h3>
        </div>
        <div class="blog_image">
            <img src="../img/happy_sun.png" width="130px" height="130px"/>
        </div>
    </div>
    <?php 
        $get_blog = get_blogs();
        foreach($get_blog as $row) {
            $blogurl = get_blogurl($row['blogID']);
    ?>

    <div class="blogs_container">
        <a href="blog.php?blogID=<?php echo $row['blogID']; ?>&title=<?php echo $blogurl['blogTitle']; ?>">
            <div class="blogs_date">
                <p><em>Date: </em>
                

                    <?php 
            //                    echo $row['datetime'];
            $phpdate = strtotime( $row['datetime'] );
            $mysqldate = date( 'd F Y', $phpdate );
            echo $mysqldate
        ?>
               
                </p>
            </div>
            <div class="blogs_title">
                <p><em>Title: </em>
                    <?php
                        echo $row['blogTitle'];
                    ?>
                </p>
            </div>
        </a>
    </div>
    
    <?php
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['account'] == 'admin') {
    ?>
    <div class="blog_entry">
        <form method="post" action="../../controller/blogentry.php">
            <label for="blogtitle">Title</label>
            <input id="blogtitle" name="blogtitle" type="text"/>
            <label for="blogentry">Add new blog entry: </label>
            <textarea id="blogentry" name="blogentry"></textarea>
            <input type="hidden" name="authorID" value="<?php echo $_SESSION['userid']; ?>"/>
            <button type="submit">Submit</button>
        </form> 
    </div>
    <?php
        }
    ?>
</div>
<?php
    include 'footer.php';
?>