//Shows loading animation while waiting for page to load

$(document).ready(function() {
    var $pageloading = $('#pageloader').show();
    $pageloading.hide();
});

//Shows loading animation while ajax is loading
var $loading = $('#loader').hide();
var $loading = $('#loader');
$(document)
  .ajaxStart(function () {
    $loading.show();
  })
  .ajaxStop(function () {
    $loading.hide();
  });

//Checking if user is browsing from a mobile device
$(document).ready(function() {
var isMobile = /iPhone|iPad|iPod|Android|Windows Phone/i.test(navigator.userAgent);

if (isMobile) {
    console.log("You are using Mobile");
} else {
    console.log("You are using Desktop");
}
});

//This function is called from the 'php/games.php' and 'php/individual_games.php' modals
function addgamemodal() { 
    document.getElementById("addgame").showModal(); 
} 

//These functions are called from 'php/individual_games.php' to switch between game comments and fix comments. 
function tabOne() {
    document.getElementById("gamecomment").style.display = "block";
    document.getElementById("fixcomment").style.display = "none";
    document.getElementById("tabone").style.background = "#FCE54A";
    document.getElementById("tabtwo").style.background = "#EEAC4E";
}
function tabTwo() {
    document.getElementById("fixcomment").style.display = "grid";
    document.getElementById("gamecomment").style.display = "none";
    document.getElementById("tabone").style.background = "#EEAC4E";
    document.getElementById("tabtwo").style.background = "#FCE54A";
}

//These toggle functions are called to toggle reply and view replies on the game comments and fixes
function togglereply($replyID) {
    var x = document.getElementById("reply_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleviewreply($replyID) {
    var x = document.getElementById("replyview_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "grid";
    } else {
        x.style.display = "none";
    }
}
function togglefixreply($replyID) {
    var x = document.getElementById("fixreply_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function toggleviewfixcomm($replyID) {
    var x = document.getElementById("replyfixview_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "grid";
    } else {
        x.style.display = "none";
    }
}

function toggleaddfixcomment($replyID) {
    var x = document.getElementById("fixcomment_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    } 
}

function togglefixcomment($replyID) {
    var x = document.getElementById("fixcomments_" + $replyID);
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "grid";
    } else {
        x.style.display = "none";
    } 
}

//This function is called from the 'php/register.php' registration form
function checkuser()
{
    var username=document.getElementById( "username" ).value;
    if (username.length < 5) {
        document.getElementById("error_register_user").innerHTML = "Username must be a minimum of 5 characters";
        document.getElementById("username").style.borderColor = "red";
        document.getElementById("username_status").style.display = "none";
    } else if (username.length > 30) {
        document.getElementById("error_register_user").innerHTML = "Username must be a maximum of 30 characters";
        document.getElementById("username").style.borderColor = "red";
        document.getElementById("username_status").style.display = "none";
    } else if(username)
    {
        $.ajax({
            type: 'get',
            url: '../../controller/checkuser.php?user_name=' + username,
            success: function (response) {
                $( '#username_status' ).html(response);
                
                if(response=="Username is available")
                {
                document.getElementById("username").style.borderColor = "green";
                document.getElementById("username_status").style.color = "green";
                document.getElementById("username_status").style.display = "block";
                document.getElementById("error_register_user").innerHTML = ""
                    return true;     
                } else {
                    console.log(response);
                    document.getElementById("username").style.borderColor = "red";
                    document.getElementById("username_status").style.display = "block";
                    document.getElementById("username_status").style.color = "red";
                    document.getElementById("error_register_user").innerHTML = ""
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

////This function is called from the 'php/individual_games.php' thumbs up for motion sickness
//function updatethumbsup(thumb_id) {
//    $.ajax( {
//        url: '../../controller/thumbs_yes_increment.php?gameID=' + thumb_id,
//        method: 'post',
//        data: $('#game_yes').serialize(),
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//            document.getElementById("loader").style.display = "none";
//        },
//        error: function(err) {
//            console.log(err);
//        }
//        
//    });
//    //The variable x is created within view/php/individual_games.php
//    document.getElementById("thup").innerHTML = (x+1);
//    document.getElementById("game_yes").disabled = true;
//    document.getElementById("game_no").disabled = true;
//}
//
////This function is called from the 'php/individual_games.php' thumbs down for motion sickness
//function updatethumbsdown(thumb_id) { 
//    $.ajax( {
//        url: '../../controller/thumbs_no_increment.php?gameID=' + thumb_id,
//        method: 'post',
//        data: $('#game_no').serialize(),
//        datatype: 'json',
//        success: function(res) {
//            console.log(res);
//        },
//        error: function(err) {
//            console.log(err);
//        }
//    });
//    //The variable y is created within view/php/individual_games.php
//    document.getElementById("thdown").innerHTML = (y+1);
//    document.getElementById("game_yes").disabled = true;
//    document.getElementById("game_no").disabled = true;
//}

function validateForm() {
    
    var password = document.getElementById("password");
    var errdiv = document.getElementById("error_register_pass");
    if (password.value === '') {
        password.style.borderColor = "red";
        errdiv.innerHTML = "This field cannot be empty";
        return false;
    } 
    if (password.checkValidity() == false) {
        password.style.borderColor = "red";
        errdiv.style.color = "red";
        errdiv.innerHTML = "Password must be between 7 and 30 characters";
        return false;
        
    } else if(password.checkValidity() == true) {
        password.style.borderColor = "green";
        errdiv.style.color = "green";
        errdiv.innerHTML = "";
        return true;
    }
    var comment = document.getElementById("gamecomment");
    if (comment.value === '' || comment.value === '<div><br></div>') {
        comment.style.borderColor = "red";
        document.getElementById("gamecomment_error").innerHTML = "This field cannot be empty";
        return false;
    }
    return true;
}

function selectAvatar() {
    var x = document.getElementById("newAvatar");
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "block";
        x.style.padding = "5px";
    } else {
        x.style.display = "none";
        x.style.padding = "0";
    } 
}

function show_changepw() {
    var x = document.getElementById("changepw");
    if (!x.style.display || x.style.display === "none") {
        x.style.display = "block";
        x.style.padding = "5px";
        x.style.marginTop = "5px";
    } else {
        x.style.display = "none";
        x.style.padding = "0";
        x.style.marginTop = "0";
    } 
}



        




