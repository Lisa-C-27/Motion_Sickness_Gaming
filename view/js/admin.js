function viewuserbutton() {
    document.getElementById("viewUsers").style.display = "block";
    document.getElementById("hide").style.display = "block";
    document.getElementById("view").style.display = "none";
}
function hideuserbutton() {
    document.getElementById("viewUsers").style.display = "none";
    document.getElementById("view").style.display = "block";
    document.getElementById("hide").style.display = "none";
}

function deletecomm(type,id) {
    var r = confirm("Are you sure you want to delete!");
    if (r == true) { 
        if (type == 'fix') {
            var $url = "../../controller/delete.php?type=fix&id=" + id;
        } else if (type == 'fixcomm') {
            var $url = "../../controller/delete.php?type=fixcomm&id=" + id;
        } else if(type == 'fixreply') {
            var $url = "../../controller/delete.php?type=fixreply&id=" + id;
        } else if(type == 'gamecomm') {
            var $url = "../../controller/delete.php?type=gamecomm&id=" + id;
        } else if(type == 'gamereply') {
            var $url = "../../controller/delete.php?type=gamereply&id=" + id;
        }
        $.ajax( {
            url: $url,
            method: 'get',
            datatype: 'json',
            success: function(res) {
                console.log(res);
                if (alert('Successfully deleted')) {}
                else window.location.reload();
                    ;
            },
            error: function(err) {
                console.log(err);
                alert('Error deleting');
            }
        });
    }
}
function undeletecomm(type, id) {
    var r = confirm("Are you sure you want to re-instate!");
    if (r == true) { 
        if (type == 'fix') {
            var $url = "../../controller/delete.php?type=undofix&id=" + id;
        } else if (type == 'fixcomm') {
            var $url = "../../controller/delete.php?type=undofixcomm&id=" + id;
        } else if(type == 'fixreply') {
            var $url = "../../controller/delete.php?type=undofixreply&id=" + id;
        } else if(type == 'gamecomm') {
            var $url = "../../controller/delete.php?type=undogamecomm&id=" + id;
        } else if(type == 'gamereply') {
            var $url = "../../controller/delete.php?type=undogamereply&id=" + id;
        }
        $.ajax( {
            url: $url,
            method: 'get',
            datatype: 'json',
            success: function(res) {
                console.log(res);
                if (alert('Successfully reinstated')) {}
                else window.location.reload();
            },
            error: function(err) {
                console.log(err);
                alert('Error reinstating');
            }
        });
    }
}

function changestatus(type, id) {
    if (type == 'disable') {
        var r = confirm("Are you sure you want to disable!");
        var $url = "../../controller/change_status.php?type=disable&id=" + id;
    } else if (type == 'active') {
        var r = confirm("Are you sure you want to enable!");
        var $url = "../../controller/change_status.php?type=active&id=" + id;
    } else if (type == 'admin') {
        var r = confirm("Are you sure you want to give this user admin access!");
        var $url = "../../controller/change_status.php?type=admin&id=" + id;
    } else if (type == 'removeadmin') {
        var r = confirm("Are you sure you want to remove admin access!");
        var $url = "../../controller/change_status.php?type=active&id=" + id;
    }
    if (r == true) { 
        $.ajax( {
            url: $url,
            method: 'get',
            datatype: 'json',
            success: function(res) {
                console.log(res);
                if (alert('Successfully changed status')) {}
                else window.location.reload();
            },
            error: function(err) {
                console.log(err);
                alert('Error changing status');
            }
        });
    }
}