function find_in_user(id) {
    var user = document.getElementById(id).value;
    if (user.trim() == "") {
        return;
    }
    $.post("fnuser.php",
        {
            id: id,
            user: user
        }, function (msg) {
            resid = "resdiv" + id;
            if (resid != "") {
                document.getElementById(resid).innerHTML = msg;
            }
            else {
                document.getElementById(resid).innerHTML = "";
            }
        });
}