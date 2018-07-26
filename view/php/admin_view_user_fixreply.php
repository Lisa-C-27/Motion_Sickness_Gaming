<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3 class="nomargin">Fix Replies</h3>
            </div>
        </div>
        <div class="col2">
            <div class="tablehead">
                <h3 class="nomargin">Date Added</h3>
            </div>
        </div>
        <div class="col3">
            <div class="tablehead">
                <h3 class="nomargin">Action</h3>
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
            <p class="nomargin">
                <?php echo $row['fixReply']; ?> 
                <em class="orange">This reply was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p class="nomargin">
                <?php echo $row['fixReply'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p class="nomargin">
                <?php echo $row['fixReplyDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p class="nomargin">
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
            <p class="nomargin">No replies to display</p>
        </div>
        <div class="col2">
            <p class="nomargin">-</p>
        </div>
        <div class="col3">
            <p class="nomargin">-</p>
        </div>
    </div>
        <?php
            }
        ?>
</div>