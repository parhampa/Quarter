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

var placeid = "";
var input = {
    type: "",
    name: "",
    id: "",
    classes: "",
    values: "",
    onclick: "",
    onchange: "",
    onkeypress: "",
    style: "",
    placeholder: ""
};

function makeinput() {

    var strinput = '<input type="'
        + input.type +
        '" name="'
        + input.name +
        '" id="'
        + input.id +
        '" class="'
        + input.classes +
        '" value="'
        + input.values +
        '" onclick="'
        + input.onclick +
        '" onchange="'
        + input.onchange +
        '" style="'
        + input.style +
        '" placeholder="'
        + input.placeholder +
        '" onkeypress="' + input.onkeypress + '">';
    document.getElementById(placeid).innerHTML = document.getElementById(placeid).innerHTML + strinput;
    input = {
        type: "",
        name: "",
        id: "",
        classes: "",
        values: "",
        onclick: "",
        onchange: "",
        style: "",
        placeholder: ""
    };
}

var select = {
    name: "",
    id: "",
    classes: "",
    values: [],
    titles: [],
    onclick: "",
    onchange: "",
    style: "",
    selectedval: "",

};

function add_select_array(val, title) {
    select.values.push(val);
    select.titles.push(title);
}

function makeselect() {
    var resselect = '<select id="'
        + select.id +
        '" name="'
        + select.name +
        '" class="'
        + select.classes +
        '" onclick="'
        + select.onclick +
        '" onchange="'
        + select.onchange +
        '" style="'
        + select.style +
        '">';
    for (var i = 0; i < select.titles.length; i++) {
        resselect = resselect + '<option value="' + select.values[i] + '">' + select.titles[i] + '</option>';
    }
    resselect = resselect + "</select>";
    document.getElementById(placeid).innerHTML = document.getElementById(placeid).innerHTML + resselect;
    if (select.selectedval != "") {
        var count_select = document.getElementsByTagName('select').length;
        document.getElementsByTagName('select')[count_select - 1].value = select.selectedval;
    }
    select = {
        name: "",
        id: "",
        classes: "",
        values: [],
        titles: [],
        onclick: "",
        onchange: "",
        style: "",
        selectedval: "",

    };
}

var textarea = {
    name: "",
    id: "",
    classes: "",
    values: "",
    onclick: "",
    onchange: "",
    style: ""
};

function make_textarea() {
    var resarea = '<textarea name="'
        + textarea.name +
        '" id="'
        + textarea.id +
        '" class="'
        + textarea.classes +
        '" onclick="'
        + textarea.onclick +
        '" onchange="'
        + textarea.onchange +
        '" style="'
        + textarea.style +
        '">';

    resarea = resarea + textarea.values + "</textarea>";
    document.getElementById(placeid).innerHTML = document.getElementById(placeid).innerHTML + resarea;
    textarea = {
        name: "",
        id: "",
        classes: "",
        values: "",
        onclick: "",
        onchange: "",
        style: ""
    };
}

var label = {
    title: "",
    id: "",
    classes: "",
    onclick: "",
    onchange: "",
    style: "font-weight: bold;"
};

function make_label() {
    var reslabel = '<label id="'
        + label.id +
        '" class="'
        + label.classes +
        '" onclick="'
        + label.onclick +
        '" onchange="'
        + label.onchange +
        '" style="'
        + label.style +
        '">'
        + label.title +
        '</label>';
    document.getElementById(placeid).innerHTML = document.getElementById(placeid).innerHTML + reslabel;
    label = {
        title: "",
        id: "",
        classes: "",
        onclick: "",
        onchange: "",
        style: "font-weight: bold;"
    };
}

var spanbtn = {
    id: "",
    title: "",
    onclick: "",
    classes: "",
    style: ""
};

function make_span_btn() {
    var resbtn = '<span id="'
        + spanbtn.id +
        '" onclick="'
        + spanbtn.onclick +
        '" class="'
        + spanbtn.classes +
        '" style="'
        + spanbtn.style +
        '">'
        + spanbtn.title +
        '</span>';
    document.getElementById(placeid).innerHTML = document.getElementById(placeid).innerHTML + resbtn;
    spanbtn = {
        id: "",
        title: "",
        onclick: "",
        classes: "",
        style: ""
    };
}

function checkempty(id, title) {
    var valch = document.getElementById(id).value;
    if (valch.trim() == "") {
        alert("لطفا مقدار " + title + " را وارد نمایید.");
        return false;
    }
    return true;
}

function load_slid_btn(btnplace, slideclass, slidecount) {
    var res = "";
    if (slidecount > 1) {
        for (i = 0; i < slidecount; i++) {
            var btncountnumber = i + 1;
            res += "<span style='border-radius: 50px;' class='w3-btn w3-red' onclick='changepic(" + '"' + slideclass + '"' + "," + slidecount + "," + i + ")" + "'>" + btncountnumber + "</span>";
        }
        document.getElementById(btnplace).innerHTML = res;
    }
}

function hideallpic(classname, slidecount) {
    for (i = 0; i < slidecount; i++) {
        document.getElementsByClassName(classname)[i].style.display = "none";
    }
}

function changepic(classname, slidecount, slidvar) {
    hideallpic(classname, slidecount);
    document.getElementsByClassName(classname)[slidvar].style.display = "";
}

function gotopage(pageid) {
    var countpg = document.getElementsByClassName("page").length;
    for (var i = 0; i < countpg; i++) {
        document.getElementsByClassName("page")[i].style.display = "none";
    }
    //alert(pageid);
    document.getElementById(pageid).style.display = "";
    var newpage = "#" + pageid;
    location.replace(newpage);
    onLoad();
}

function loadpages() {
    var countpg = document.getElementsByClassName("page").length;
    for (var i = 0; i < countpg; i++) {
        document.getElementsByClassName("page")[i].style.display = "none";
    }
    document.getElementsByClassName('page')[0].style.display = "";
    location.replace("#");
    onLoad();
}

function fastinput(input_name, input_type, input_title, form_class = "") {
    label.title = input_title;
    label.classes = "w3-text-green";
    make_label();
    input.name = input_name;
    input.id = input_name;
    input.classes = "w3-input w3-border " + form_class;
    input.type = input_type
    makeinput();
}

function fastbtn(btn_title, onclick = "") {
    spanbtn.title = btn_title;
    spanbtn.onclick = onclick;
    spanbtn.classes = "w3-btn w3-green w3-margin w3-round";
    make_span_btn();
}

function getbyid(id) {
    return document.getElementById(id).value;
}

function getpgname(id) {
    var link = window.location.href;
    if (link.indexOf(id) != -1) {
        return true;
    } else {
        return false;
    }
}