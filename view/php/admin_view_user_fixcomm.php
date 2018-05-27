<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3>Fix Comments</h3>
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
    $getAllUserFixComm = getAllUserComments('fixcomm', $_GET['userID']);
    if (!empty($getAllUserFixComm)) {
        foreach($getAllUserFixComm as $row) { 
    ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p>
                <?php echo $row['fixComment']; ?> 
                <em class="orange">This comment was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p>
                <?php echo $row['fixComment'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p>
                <?php echo $row['fixCommDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p>
            <?php
                if($row['deleted'] == true) {
            ?>  
                <a href="#" onclick="undeletecomm('fixcomm', <?php echo $row['fixCommID'] ?>);">Undo</a>
            <?php
                } else {
            ?>
                <a href="#" onclick="deletecomm('fixcomm', <?php echo $row['fixCommID'] ?>);">Delete</a>
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