//This function is called from the 'php/games.php' and 'php/individual_games.php' modals
function addgamemodal() { 
    document.getElementById("addgame").showModal(); 
} 

//These functions are called from 'php/individual_games.php' to switch between game comments and fix comments. Currently not working properly. Needs fixing  
function tabOne() {
    document.getElementById("gamecomment").style.display = "block";
    document.getElementById("fixcomment").style.display = "none";
}
function tabTwo() {
    document.getElementById("fixcomment").style.display = "block";
    document.getElementById("gamecomment").style.display = "none";
}

//This function is called from the 'php/register.php' registration form
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

//This function is called from 'php/games.php' Add game modal onchange
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

//This function is called from the 'php/individual_games.php' thumbs up for motion sickness
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
    //The variable x is created within view/php/individual_games.php
    document.getElementById("thup").innerHTML = (x+1);
    document.getElementById("game_yes").disabled = true;
    document.getElementById("game_no").disabled = true;
}

//This function is called from the 'php/individual_games.php' thumbs down for motion sickness
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
    //The variable y is created within view/php/individual_games.php
    document.getElementById("thdown").innerHTML = (y+1);
    document.getElementById("game_yes").disabled = true;
    document.getElementById("game_no").disabled = true;
}

//function getThumbsforRep() {
//   
//                        
//    window.onload = function() {
//
//        //For debugging
//            console.log(first);
//            console.log(second);
//
//    if (first <= 50) {
//    document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "Newbie";
//    } else if (first > 50 && a <= 100) {
//    document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "Community";
//    } else {
//        document.getElementById('<?php echo $getrep['username']; ?>_comm').innerHTML = "The Best";
//    }
//    if (second <= 50) {
//    document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Newbie fixer";
//    } else if (second > 50 && a <= 100) {
//    document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Community Fixer";
//    } else {
//        document.getElementById('<?php echo $getrep['username']; ?>_fix').innerHTML = "Best Fixer";
//    }
//        }
//                         
//}
//Trying to calculate the reputation and display
//function calcRep() {
//    var first = number('name: gameCommThUp');
//    
//}


//function addgame() {
//    var game = document.getElementById( "gamename" ).value;
//    if(game) {
//        $.ajax({
//            type: 'post',
//            url: '../../controller/insertgame.php',
//            data: {
//                submit_game:game,
//            },
//            success: function (response) {
//                $( '#errorsection' ).html(response.msg);
//                console.log(response);
//                if(response=="Game is not in library, please add")	{
//                    return true;	
//                } else {
//                    return false;	
//                }
//            },
//            error: function(err) {
//                console.log('bad?');
//            }
//        });
//     } else {
//        $( '#errorsection' ).html("");
//        return false;
//     }
//}


