<div class="gamevote">
    <p>Does this game give you motion sickness?</p>
        <form class="inline">
            <input type="hidden" name="action_type" value="addgamethup"/>
            <button type="button" id="game_yes" class="pure-button thumbs" onclick="updatethumbsup(<?php echo $_GET['gameID']; ?>)">
                Yes 
<!--                <i class="fas fa-thumbs-up"></i>-->
            </button>
            <span id="thup"><?php echo $gamedetails['gameThUp'];?></span>  
        </form>
        <form class="inline">
            <input type="hidden" name="action_type" value="addgamethdown"/>
            <button type="button" id="game_no" class="pure-button thumbs" onclick="updatethumbsdown(<?php echo $_GET['gameID']; ?>)">
                No 
<!--                <i class="fas fa-thumbs-down"></i>-->
            </button>
            <span id="thdown"><?php echo $gamedetails['gameThDown'];?></span>
        </form>
</div>