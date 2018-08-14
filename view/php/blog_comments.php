<div id="blogcomments">
    <?php

    $getcomments = getBlogComments($_GET['blogID']);
    if (!empty($getcomments)) {
        foreach($getcomments as $row) {
    ?>
    <div class="outer-container">
        <div class="databaseComments">
            <div class="comment-top">
                <div class="userinfo">  
                    <span class="username"><?php echo $row['username'] ?></span>
                    <span class="commrep">
                        <?php
                            $getrep = getThumbs($row['userID']);
                            include 'rep_comments.php';
                        ?>
                    </span>
                    <span class="date">
                        <?php 
                            $phpdate = strtotime( $row['datetime'] );
                            $mysqldate = date( 'd M Y g:i A', $phpdate );
                            echo $mysqldate
                        ?>
                    </span>
                </div>
                <div class="vote">
                </div>
            </div>
            <div class="comment-bottom">
                <div class="comment-avatar center">
                    <img class="avatar" src="<?php echo $row['url']; ?>"/>
                </div>
                <div class="gamecomment">
                    <p>
                        <?php 
                            if($row['deleted'] == true) {
                                echo "<em>This comment was deleted by Motion Sickness Gaming administration</em>";
                            } else {
                                echo $row['newcomment']; 
                            }
                        ?>
                    </p>
                </div>
                <div class="reply">
                    <p>
                        <?php 
                        if(isset($_SESSION['userid'])) {            if($_SESSION['userid'] == $row['userID']) {
                        ?>
                        <a href="#" onclick="editComment('blogcomm', <?php echo $row['blogcommID'] ?>);">Edit</a> | 
                        <a href="#" onclick="userdeletecomm('blogcomm', <?php echo $row['blogcommID'] ?>);">Delete</a>
                        <?php
                        }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php   
}
} else {
?>
<p class="nocomments">No comments to display</p>
<?php
}
?>
</div>