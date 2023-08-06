var placeid = "";
var input = {
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
        '">';
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