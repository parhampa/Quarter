var postobj = {
    data_array: {},
    post_url: "",
    after_post_url: "",
    send_type: "",
    after_success: function () {
    },
    after_error: function () {
    }
};

function empty_postobj() {
    postobj = {
        data_array: {},
        post_url: "",
        after_post_url: "",
        send_type: "",
        after_success: function () {
        },
        after_error: function () {
        }
    };
}

function res_obj_postdata(classname) {
    for (var i = 0; i < document.getElementsByClassName(classname).length; i++) {
        postobj.data_array[document.getElementsByClassName(classname)[i].name] = document.getElementsByClassName(classname)[i].value;
    }

    $.ajax({
        url: postobj.post_url,
        data: postobj.data_array,
        type: postobj.send_type,
        error: function () {
            postobj.after_error();
            //empty_postobj();
        },
        success: function (data) {
            postobj.after_success(data);
            //empty_postobj();
        }
    });


}