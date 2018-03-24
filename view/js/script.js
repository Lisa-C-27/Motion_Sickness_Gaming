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

function checkuser() {
    var email=document.getElementById( "username_reg" ).value;
    if(email) {
        $.ajax({
            type: 'post',
            url: 'checkuser.php',
            data: {
                user_email:email,
            },
            success: function (response) {
                $( '#username_status' ).html(response);
                if(response=="Username is available")	{
                    return true;	
                } else {
                    return false;	
                }
            }
        });
     } else {
        $( '#username_status' ).html("");
        return false;
     }
}

function checkall() {
    var unamehtml=document.getElementById( "username_status" ).innerHTML;
    if((unamehtml)=="Username is available") {
      return true;
     } else {
      return false;
     }
}

function checkgame() {
    var game=document.getElementById( "gamename" ).value;
    if(game) {
        $.ajax({
            type: 'post',
            url: 'checkgame.php',
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

function checkallgame() {
    var gamehtml=document.getElementById("game_status").innerHTML;
    if((gamehtml)=="Game is not in library, please add") {
      return true;
     } else {
      return false;
     }
}
function thumbsup() {
   
    
}

// Code below is not finished - attempting to get thumbs up / down working

//$(function (){
//    $('#yes').click(function(){
//        var request = $.ajax({
//            type: "POST",
//            url: "../../model/thumbs_increment.php"
//        });
//        request.done(function( msg ) {
//            alert('Success');
//            return;
//        });
//        request.fail(function(jqXHR, textStatus) {
//            alert( "Request failed: " + textStatus );
//        });
//    });
//});
//
//$(function (){
//    $('#no').click(function(){
//        var request = $.ajax({
//            type: "POST",
//            url: "../../model/thumbs_increment.php"
//        });
//        request.done(function( msg ) {
//            alert('Success');
//            return;
//        });
//        request.fail(function(jqXHR, textStatus) {
//            alert( "Request failed: " + textStatus );
//        });
//    });
//});
