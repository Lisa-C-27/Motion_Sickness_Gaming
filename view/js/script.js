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

//This function is called from the 'php/individual_games.php' thumbs up for motion sickness
function updatethumbsup(thumb_id) {
    $.ajax( {
        url: '../../controller/thumbs_yes_increment.php?gameID=' + thumb_id,
        method: 'post',
        data: $('#game_yes').serialize(),
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("loader").style.display = "none";
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

//Shows loading animation while waiting for page to load
var $pageloading = $('#pageloader').show();

$(document).ready(function() {
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


//Can't get this to work - what am I doing wrong???
//function validateForm() {
//    var constraints = {
//        
//        usernamereg: {
//            presence: true,
////            format: {
////                pattern: "[a-zA-Z0-9_]{5,30}",
////                message: "Can only contain lowercase, uppercase, numbers and underscores"
////            }
//            length: {
//                minimum: 5,
//                maximum: 30,
//                message: "Must be between 5 and 30 characters"
//            }
//        }
//    };
//    validate({usernamereg}, constraints);
//}

function validateForm() {
    
    var password = document.getElementById("password");
    if (password.value === '') {
        password.style.borderColor = "red";
        document.getElementById("error_register_pass").innerHTML = "This field cannot be empty";
        return false;
    } 
    if (password.checkValidity() == false) {
        password.style.borderColor = "red";
        document.getElementById("error_register_pass").innerHTML = "Password must be between 7 and 30 characters";
        return false;
    }
    var comment = document.getElementById("gamecomment");
    if (comment.value === '' || comment.value === '<div><br></div>') {
        comment.style.borderColor = "red";
        document.getElementById("gamecomment_error").innerHTML = "This field cannot be empty";
        return false;
    }
    return true;
}

function viewuserbutton() {
    document.getElementById("viewUsers").style.display = "grid";
    document.getElementById("hide").style.display = "block";
    document.getElementById("view").style.display = "none";
}
function hideuserbutton() {
    document.getElementById("viewUsers").style.display = "none";
    document.getElementById("view").style.display = "block";
    document.getElementById("hide").style.display = "none";
}

function updatethumb_gamecomm(direction, id) {
    $url = "../../controller/thumbs_increment.php?type=comment&direction="+direction+ "&commID="+id;
    if(direction == "up") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("up_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
    if(direction == "down") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("down_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
}

function updatethumb_gamereply(direction, id) {
    $url = "../../controller/thumbs_increment.php?type=reply&direction="+direction+ "&commID="+id;
    if(direction == "up") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("replyup_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
    if(direction == "down") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("replydown_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
}

function updatethumb_fix(direction, id) {
    $url = "../../controller/thumbs_increment.php?type=fix&direction="+direction+ "&commID="+id;
    if(direction == "up") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixup_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
    if(direction == "down") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixdown_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
}

function updatethumb_fixcomm(direction, id) {
    $url = "../../controller/thumbs_increment.php?type=fixcomment&direction="+direction+ "&commID="+id;
    if(direction == "up") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixcommup_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
    if(direction == "down") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixcommdown_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
}

function updatethumb_fixreply(direction, id) {
    $url = "../../controller/thumbs_increment.php?type=fixreply&direction="+direction+ "&commID="+id;
    if(direction == "up") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixreplyup_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
    if(direction == "down") {
        $.ajax( {
        url: $url,
        method: 'get',
        datatype: 'json',
        success: function(res) {
            console.log(res);
            document.getElementById("fixreplydown_"+id).value++;
        },
        error: function(err) {
            console.log(err);
        }
    });
    }
}

//function addComment() {
//    var gameComment=document.getElementById( "gamecomment" ).value;
//    if(gameComment) {
//        $.ajax({
//            type: 'post',
//            url: '../../controller/addcomment.php',
//            data: $('#gameComment').serialize(),
////            datatype: 'json',
//            success: function (response) {
//                console.log('success');
//                console.log(response);
//                
////                $( '#game_status' ).html(response);
////                if(response=="Game is not in library, please add")	{
//                    return true;	
//                } else {
//                console.log('error');
//                    return false;	
//                } 
//        });
//     } else {
//         console.log('elseerror');
////        $( '#game_status' ).html("");
//        return false;
//     }
//}

//function insertData($table, $data){
//	GLOBAL $conn;
//     if(!empty($data) && is_array($data)){
//        $columns = '';
//        $values  = '';
//	      $columnString = implode(',', array_keys($data));
//        $valueString = ":".implode(',:', array_keys($data));
//			  $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
//        $query = $conn->prepare($sql);
//			  print_r($data);
//        foreach($data as $key=>$val){
//            $query->bindValue(':'.$key, $val);
//        }
//          $insert = $query->execute();
//    }
//	   return $insert;
//}




//if($_REQUEST['action_type'] == 'add'){
//$data = //set the variable $data within the insertData($table,$data) function to the following array
//					  array(
//							'Name' => $authName,
//							'Surname' => $authSurname,
//							'Nationality' => $authNation,
//							'BirthYear' => $birthYr,
//							'DeathYear' => $deathYr
//					    );
//						$table="author"; //table name in DB to insert data into
//						//function call from db_functions.php
//						insertData($table,$data);
//					
//<input type="hidden" name="action_type" value="add"/> //Add this to form section

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


