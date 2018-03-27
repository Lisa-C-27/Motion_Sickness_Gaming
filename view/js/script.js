function addgamemodal() { 
    document.getElementById("addgame").showModal(); 
} 

function tabOne() {
    gamecomment.style.display = "block";
    fixcomment.style.display = "none";
}
function tabTwo() {
    fixcomment.style.display = "block";
    gamecomment.style.display = "none";
}

function checkuser()
{
    var username=document.getElementById( "usernamereg" ).value;
    if(username)
    {
        $.ajax({
            type: 'post',
            url: '../../controller/checkuser.php',
            data: {
                user_name:username,
            },
            success: function (response) {
                $( '#username_status' ).html(response);
                
                if(response=="Username is available")
                {
                    
                    return true;     
                } else {
                    console.log(response);
                    return false;	  
                }
            }
        });
     } 
    else 
    {
        $( '#username_status' ).html("");
        return false;
    }
}

function checkgame() {
    var game=document.getElementById( "gamename" ).value;
    if(game) {
        $.ajax({
            type: 'post',
            url: '../../controller/checkgame.php',
            data: {
                user_email:game,
            },
            success: function (response) {
                $( '#game_status' ).html(response);
                if(response=="Game is not in library, please add")	{
                    return true;	
                } else {
                    return false;	
                }
            }
        });
     } else {
        $( '#game_status' ).html("");
        return false;
     }
}


function addgame() {
    var game = document.getElementById( "gamename" ).value;
    if(game) {
        $.ajax({
            type: 'post',
            url: '../../controller/insertgame.php',
            data: {
                submit_game:game,
            },
            success: function (response) {
                $( '#errorsection' ).html(response.msg);
                console.log(response);
                if(response=="Game is not in library, please add")	{
                    return true;	
                } else {
                    return false;	
                }
            },
            error: function(err) {
                console.log('bad?');
            }
        });
     } else {
        $( '#errorsection' ).html("");
        return false;
     }
}

function updatethumbsup(thumb_id) { 
    $.ajax( {
        url: '../../controller/thumbs_yes_increment.php?gameID=' + thumb_id,
        method: 'post',
        data: $('#game_yes').serialize(),
        datatype: 'json',
        success: function(res) {
            console.log(res);
        },
        error: function(err) {
            console.log(err);
        }
    });
    document.getElementById("thup").innerHTML = (x+1);
    document.getElementById("game_yes").disabled = true;
    document.getElementById("game_no").disabled = true;
}

function updatethumbsdown(thumb_id) { 
    $.ajax( {
        url: '../../controller/thumbs_no_increment.php?gameID=' + thumb_id,
        method: 'post',
        data: $('#game_no').serialize(),
        datatype: 'json',
        success: function(res) {
            console.log(res);
        },
        error: function(err) {
            console.log(err);
        }
    });
    document.getElementById("thdown").innerHTML = (y+1);
    document.getElementById("game_yes").disabled = true;
    document.getElementById("game_no").disabled = true;
}
