<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3>Fix Replies</h3>
            </div>
        </div>
        <div class="col2">
            <div class="tablehead">
                <h3>Date Added</h3>
            </div>
        </div>
        <div class="col3">
            <div class="tablehead">
                <h3>Action</h3>
            </div>
        </div>
    </div>
    <?php
    $getAllUserFixReply = getAllUserComments('fixreply', $_GET['userID']);
    if (!empty($getAllUserFixReply)) {
        foreach($getAllUserFixReply as $row) { 
    ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p>
                <?php echo $row['fixReply']; ?> 
                <em class="orange">This reply was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p>
                <?php echo $row['fixReply'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p>
                <?php echo $row['fixReplyDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p>
            <?php
                if($row['deleted'] == true) {
            ?>  
                <a href="#" onclick="undeletecomm('fixreply', <?php echo $row['fixReplyID'] ?>);">Undo</a>
            <?php
                } else {
            ?>
                <a href="#" onclick="deletecomm('fixreply', <?php echo $row['fixReplyID'] ?>);">Delete</a>
            <?php
                }
            ?>
            </p>
        </div>
    </div>
        <?php
            }
        } else {
    ?>
    <div class="row">
        <div class="col1">
            <p>No replies to display</p>
        </div>
        <div class="col2">
            <p>-</p>
        </div>
        <div class="col3">
            <p>-</p>
        </div>
    </div>
        <?php
            }
        ?>
</div>