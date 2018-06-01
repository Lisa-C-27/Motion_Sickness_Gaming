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
        if(direction == "up") {
           var div = document.getElementById("replyup_"+id);
        } else if (direction == "down") {
            var div = document.getElementById("replydown_"+id);
        }
    } else if(type == "fix") {
        var $url = "../../controller/thumbs_increment.php?type=fix&direction="+direction+ "&commID="+id+ "&userID="+userID;
        if(direction == "up") {
            var div = document.getElementById("fixup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("fixdown_"+id);
        }
    } else if(type == "fixcomm") {
        var $url = "../../controller/thumbs_increment.php?type=fixcomment&direction="+direction+ "&commID="+id+ "&userID="+userID;
        if(direction == "up") {
            var div = document.getElementById("fixcommup_"+id);
        } else if(direction == "down") {
            var div = document.getElementById("fixcommdown_"+id);
        }
    } else if(type == "fixreply") {
        var $url = "../../controller/thumbs_increment.php?type=fixreply&direction="+direction+ "&commID="+id+ "&userID="+userID;
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


//
//function updatethumb_gamecomm(direction, id, userID) {
//    $url = "../../controller/thumbs_increment.php?type=comment&direction="+direction+ "&commID="+id+ "&userID="+userID;
//    if(direction == "up") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("up_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//    if(direction == "down") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("down_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//}
//
//function updatethumb_gamereply(direction, id, userID) {
//    $url = "../../controller/thumbs_increment.php?type=reply&direction="+direction+ "&commID="+id+ "&userID="+userID;
//    if(direction == "up") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("replyup_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//    if(direction == "down") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("replydown_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//}
//
//function updatethumb_fix(direction, id, userID) {
//    $url = "../../controller/thumbs_increment.php?type=fix&direction="+direction+ "&commID="+id+ "&userID="+userID;
//    if(direction == "up") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixup_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//    if(direction == "down") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixdown_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//}
//
//function updatethumb_fixcomm(direction, id, userID) {
//    $url = "../../controller/thumbs_increment.php?type=fixcomment&direction="+direction+ "&commID="+id+ "&userID="+userID;
//    if(direction == "up") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixcommup_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//    if(direction == "down") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixcommdown_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//}
//
//function updatethumb_fixreply(direction, id, userID) {
//    $url = "../../controller/thumbs_increment.php?type=fixreply&direction="+direction+ "&commID="+id+ "&userID="+userID;
//    if(direction == "up") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixreplyup_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//    if(direction == "down") {
//        $.ajax( {
//        url: $url,
//        method: 'get',
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("fixreplydown_"+id).value++;
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    }
//}