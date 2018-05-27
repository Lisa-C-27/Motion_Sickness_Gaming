<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3>Fix</h3>
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
    $getAllUserFix = getAllUserComments('fix', $_GET['userID']);
    if (!empty($getAllUserFix)) {
        ?>

        <?php 
            foreach($getAllUserFix as $row) { 
        ?>
    <div class="row">
        <div class="col1">
            <?php
                if($row['deleted'] == true) {
            ?>
            <p>
                <?php echo $row['fixInfo']; ?> 
                <em class="orange">This fix was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p>
                <?php echo $row['fixInfo'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p>
                <?php echo $row['fixDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p>
            <?php
                if($row['deleted'] == true) {
            ?>  
                <a href="#" onclick="undeletecomm('fix', <?php echo $row['fixID'] ?>);">Undo</a>
            <?php
                } else {
            ?>
                <a href="#" onclick="deletecomm('fix', <?php echo $row['fixID'] ?>);">Delete</a>
            <?php
                }
            ?>
            </p>
        </div>
    </div>
        <?php
            }
        ?>      
    <?php
        } else {
    ?>
    <div class="row">
        <div class="col1">
            <p>No fixes to display</p>
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