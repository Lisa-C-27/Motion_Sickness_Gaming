function updatethumb(type, direction, id, userID) {
    if(type == "gamecomm") {
        var $url = "../../controller/thumbs_increment.php?type=comment&direction="+direction+ "&commID="+id+ "&userID="+userID;
        var disable = document.getElementById("hide1_"+id);
        var disable1 = document.getElementById("hide2_"+id);
        if(direction == "up") {
            var div = document.getElementById("up_"+id);
        } else if (direction == "down") {
            var div = document.getElementById("down_"+id);
        }
    } else if(type == "gamereply") {
        var $url = "../../controller/thumbs_increment.php?type=reply&direction="+direction+ "&commID="+id+ "&userID="+userID;
        var disable = document.getElementById("hide3_"+id);
        var disable1 = document.getElementById("hide4_"+id);
        if(direction == "up") {
           var div = document.getElementById("replyup_"+id);
        } else if (direction == "down") {
            var div = document.getElementById("replydown_"+id);
        }
    } else if(type == "fix") {
        var $url = "../../controller/thumbs_increment.php?type=fix&direction="+direction+ "&commID="+id+ "&userID="+userID;
        var disable = document.getElementById("hide5_"+id);
        var disable1 = document.getElementById("hide6_"+id);
        if(direction == "up") {
            var div = document.getElementById("fixup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("fixdown_"+id);
        }
    } else if(type == "fixcomm") {
        var $url = "../../controller/thumbs_increment.php?type=fixcomment&direction="+direction+ "&commID="+id+ "&userID="+userID;
        var disable = document.getElementById("hide7_"+id);
        var disable1 = document.getElementById("hide8_"+id);
        if(direction == "up") {
            var div = document.getElementById("fixcommup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("fixcommdown_"+id);
        }
    } else if(type == "fixreply") {
        var $url = "../../controller/thumbs_increment.php?type=fixreply&direction="+direction+ "&commID="+id+ "&userID="+userID;
        var disable = document.getElementById("hide9_"+id);
        var disable1 = document.getElementById("hide10_"+id);
        if(direction == "up") {
            var div = document.getElementById("fixreplyup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("fixreplydown_"+id);
        }
    } else if(type == "game") {
        var $url = "../../controller/thumbs_increment.php?type=game&direction="+direction+ "&commID="+id;
        var disable = document.getElementById("disableup");
        var disable1 = document.getElementById("disabledown");
        if(direction == "up") {
            var div = document.getElementById("gameup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("gamedown_"+id);
        }
    }
    
    $.ajax( {
    url: $url,
    method: 'get',
    datatype: 'json',
    success: function(res) {
        console.log(res);
        disable.onclick = function() {
            this.disabled = true;
        }
        disable1.onclick = function() {
            this.disabled = true;
        }
        div.value++;
    },
    error: function(err) {
        console.log(err);
    }
});
}
