function set_select_filter(fromid, toid, filename) {
    newfilename = "selector_" + filename + ".php";
    newclass = "sendercls_" + fromid;
    document.getElementById(fromid).classList.add(newclass);
    postobj.post_url = newfilename;
    postobj.send_type = "post";
    postobj.after_success = function (data) {
        document.getElementById(toid).innerHTML = data;
    }
    res_obj_postdata(newclass);
}