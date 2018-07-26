<div class="usercomments">
    <div class="row">
        <div class="col1">
            <div class="tablehead">
                <h3 class="nomargin">Fix</h3>
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
            <p class="nomargin">
                <?php echo $row['fixInfo']; ?> 
                <em class="orange">This fix was deleted</em>
            </p>
            <?php
                } else {
            ?>
            <p class="nomargin">
                <?php echo $row['fixInfo'] ?>
            </p>
            <?php
                }
            ?>
        </div>
        <div class="col2">
            <p class="nomargin">
                <?php echo $row['fixDateTime']; ?>
            </p>
        </div>
        <div class="col3">
            <p class="nomargin">
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
            <p class="nomargin">No fixes to display</p>
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