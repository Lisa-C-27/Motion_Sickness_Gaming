<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3>Game Comments</h3>
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
    $getAllUserGameComm = getAllUserComments('gamecomm', $_GET['userID']);
    if (!empty($getAllUserGameComm)) {
        foreach($getAllUserGameComm as $row) { 
    ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p>
                <?php echo $row['gameComment']; ?> 
                <em class="orange">This comment was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p>
                <?php echo $row['gameComment'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p>
                <?php echo $row['gameCommDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p>
            <?php
                if($row['deleted'] == true) {
            ?>  
                <a href="#" onclick="undeletecomm('gamecomm', <?php echo $row['gameCommID'] ?>);">Undo</a>
            <?php
                } else {
            ?>
                <a href="#" onclick="deletecomm('gamecomm', <?php echo $row['gameCommID'] ?>);">Delete</a>
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
            <p>No comments to display</p>
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