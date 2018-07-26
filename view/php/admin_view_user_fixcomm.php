<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3 class="nomargin">Fix Comments</h3>
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
    $getAllUserFixComm = getAllUserComments('fixcomm', $_GET['userID']);
    if (!empty($getAllUserFixComm)) {
        foreach($getAllUserFixComm as $row) { 
    ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p class="nomargin">
                <?php echo $row['fixComment']; ?> 
                <em class="orange">This comment was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p class="nomargin">
                <?php echo $row['fixComment'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p class="nomargin">
                <?php echo $row['fixCommDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p class="nomargin">
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
            <p class="nomargin">No comments to display</p>
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