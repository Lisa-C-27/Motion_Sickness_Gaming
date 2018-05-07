<?php 
    // This checks if the user is logged in. If true then the Add Fix button will be displayed
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { 
    ?>
    <button type="button" class="pure-button inline" data-toggle="modal" data-target="#myModal">Add a fix</button>
    <?php
        };
?>
<!-- Add Fix Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add a possible fix for this game</h4>
            </div>
            <div class="modal-body">
                <form class="pure-form pure-form-stacked" method="post" action="../../controller/insertfix.php">
                    <p>Add as much detail as possible</p>
                    <fieldset>
                        <textarea id="fix" rows="10" cols="50" name="fix"></textarea>
                        <input type="hidden" name="gameID" value="<?php echo $_GET['gameID'] ?>"/>
                        <input type="hidden" name="userID" value="<?php echo $_SESSION['userid'] ?>"/>
                        <button type="submit" class="pure-button pure-button-primary" name="submit_fix">Add fix</button>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>  
    </div>
</div>