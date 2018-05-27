<div class="gamevote">
    <p>Does this game give you motion sickness?</p>
    <span class="gamevoting" onclick="updatethumb('game', 'up', <?php echo $_GET['gameID']; ?>, 'null');" title="<?php echo $gamedetails['gameThUp']; ?> community members voted that <?php echo $gamedetails['gameName'] ?> gave them motion sickness">
        <button type="button" class="pure-button thumbs">
            YES 
            <i class="fas fa-check-circle"></i>
        </button>
        <input type="number" class="game" disabled value="<?php echo $gamedetails['gameThUp']; ?>" id="gameup_<?php echo $gamedetails['gameID']; ?>"/>
    </span>
    <span class="gamevoting" onclick="updatethumb('game','down', <?php echo $_GET['gameID']; ?>, 'null');" title="<?php echo $gamedetails['gameThDown']; ?> community members voted that <?php echo $gamedetails['gameName'] ?> did not give them motion sickness">
        <button type="button" class="pure-button thumbs">
            NO 
            <i class="fas fa-times-circle"></i>
        </button>
        <input type="number" class="game" disabled value="<?php echo $gamedetails['gameThDown'] ?>" id="gamedown_<?php echo $gamedetails['gameID']; ?>"/>
    </span>
</div>
