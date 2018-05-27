<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3>Game Replies</h3>
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
    $getAllUserGameReply = getAllUserComments('gamereply', $_GET['userID']);
    if (!empty($getAllUserGameReply)) {
        foreach($getAllUserGameReply as $row) { 
    ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p>
                <?php echo $row['replyComment']; ?> 
                <em class="orange">This reply was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p>
                <?php echo $row['replyComment'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p>
                <?php echo $row['replyCommDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p>
            <?php
                if($row['deleted'] == true) {
            ?>  
                <a href="#" onclick="undeletecomm('gamereply', <?php echo $row['gameReplyID'] ?>);">Undo</a>
            <?php
                } else {
            ?>
                <a href="#" onclick="deletecomm('gamereply', <?php echo $row['gameReplyID'] ?>);">Delete</a>
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