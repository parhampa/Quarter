<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/2/2020
 * Time: 5:00 AM
 */


/*
 * type 0 => string
 * type 1 => numeric
 * type 2 => numeric_select
 * type 3 => bool
 * type 4 => file
 * */


class makeform
{
    public $alow_add = true;
    public $alow_del = true;
    public $alow_edit = true;
    public $alow_visit = true;

    public $formname = [];
    public $formtype = [];
    public $formtitle = [];
    public $formreq = [];
    public $formtbl = [];
    public $formfilter = [];

    public $maked = "";
    public $all = "";

    public $selects = [];
    public $sel_val = [];

    /////////////////////////////input
    public function input()
    {
        $this->maked .= '<input >';
        return $this;
    }

    public function inptype($vall)
    {
        $this->maked = str_replace('<input ', '<input type="' . $vall . '" ', $this->maked);
        if ($vall == "file") {
            $this->maked .= "<img src='' style='width: 300px; margin-top:5px;'>";
        }
        return $this;
    }

    public function inpval($vall)
    {
        $this->maked = str_replace('<input ', '<input value="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function inpplaceholder($vall)
    {
        $this->maked = str_replace('<input ', '<input placeholder="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function inpclasses($vall)
    {
        $this->maked = str_replace('<input ', '<input class="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function inpname($vall)
    {
        $this->maked = str_replace('<input ', '<input name="' . $vall . '" ', $this->maked);
        $this->maked = str_replace('<img', '<img id="imgfm' . $vall . '"', $this->maked);
        return $this;
    }

    public function inpid($vall)
    {
        $this->maked = str_replace('<input ', '<input id="' . $vall . '" ', $this->maked);
        $this->maked = $this->maked . "<div id='resdiv" . $vall . "'></div>";
        return $this;
    }

    public function onchange($vall)
    {
        $this->maked = str_replace('<input ', '<input onchange="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function select_onchange($vall)
    {
        $this->maked = str_replace('<select ', '<select onchange="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function onclick($vall)
    {
        $this->maked = str_replace('<input ', '<input onclick="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function onkeypress($vall)
    {
        $this->maked = str_replace('<input ', '<input onkeypress="' . $vall . '" ', $this->maked);
        return $this;
    }

    //////////////////////////textarea
    public function texarea()
    {
        $this->maked .= "<textarea ></textarea><br>";
        return $this;
    }

    public function areaval($vall)
    {
        $this->maked = str_replace('</textarea>', $vall . '</textarea>', $this->maked);
        return $this;
    }

    public function areaclasses($vall)
    {
        $this->maked = str_replace('<textarea ', '<textarea class="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function areaname($vall)
    {
        $this->maked = str_replace('<textarea ', '<textarea name="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function areaid($vall)
    {
        $this->maked = str_replace('<textarea ', '<textarea id="' . $vall . '" ', $this->maked);
        return $this;
    }

    //select
    public function select()
    {
        $this->maked .= "<select></select><br>";
        return $this;
    }

    public function selectclasses($vall)
    {
        $this->maked = str_replace('<select', '<select class="' . $vall . '" ', $this->maked);
        return $this;
    }


    public function selectname($vall)
    {
        $this->selects[sizeof($this->selects)] = $vall;
        $this->maked = str_replace('<select', '<select name="' . $vall . '" ', $this->maked);
        return $this;
    }

    public function selectid($vall)
    {
        $this->maked = str_replace('<select', '<select id="' . $vall . '" ', $this->maked);
        return $this;
    }

    public $selectvals = [];

    public function selectaddval($val, $option, $selected = 0)
    {
        $this->sel_val += array($val => $option);
        $selectetst = "selected";
        if ($selected == 0) {
            $selectetst = "";
        }
        $this->maked = str_replace('</select>', '<option value="' . $val . '" ' . $selectetst . '>' . $option . '</option></select>', $this->maked);
        return $this;
    }

    public function selectdb($table, $fild_title, $fild_value, $selectedval = "", $where = "")
    {
        $db = new database();
        $sql = "select * from `$table` $where";
        $db->connect()->query($sql);
        while ($fild = mysqli_fetch_assoc($db->res)) {
            $selected = 0;
            if ($selectedval == $fild[$fild_value]) {
                $selected = 1;
            }
            $this->selectaddval($fild[$fild_value], $fild[$fild_title], $selected);
        }
        return $this;
    }

    public function fileinput($label, $name, $input_class = "", $label_class = "", $req = 0)
    {
        $this->label($label, $label_class)
            ->input()
            ->inptype("file")
            ->inpname($name)
            ->inpid($name)
            ->inpclasses($input_class)
            ->end()
            ->sndform($name, 4, $req, $label);
    }

    public function submitbtn($val, $classes = "w3-btn w3-green w3-round w3-margin")
    {
        $this->input()
            ->inptype("submit")
            ->inpval($val)
            ->inpclasses($classes)
            ->end();
    }

    //////////////////////////lable
    public function label($val, $class = "")
    {
        $this->maked .= "<label class='" . $class . "'>" . $val . "</label>";
        return $this;
    }

    //////////////////////////form
    ///
    public $form_action = "";

    public function addform($method = "post", $action = "?action=addquery")
    {
        $this->form_action = $action;
        $this->all = "<form method='$method' action='$action' enctype='multipart/form-data'>" . $this->all . "</form>";
        return $this;
    }

    public function requered_fild()
    {
        $this->maked = "<span style='color: red;'>*</span>" . $this->maked;
        return $this;
    }

    public function end()
    {
        $this->all .= $this->maked;
        $this->maked = "";
        return $this;
    }

    public $settable = "";
    public $setkey = "";
    public $setkey_type = "";

    public function set_tbl_key($tbl, $key, $key_type)
    {
        $this->settable = $tbl;
        $this->setkey = $key;
        $this->setkey_type = $key_type;
        return $this;
    }

    public $wheresql = "";

    public function setwhere($sql)
    {
        $this->wheresql = $sql;
        return $this;
    }

    public $where_edit = "";

    public function set_where_edit($val)
    {
        $this->where_edit = " and " . $val;
        return $this;
    }

    public $delwhere = "";

    public function deletewhere($where)
    {
        $this->delwhere = " and " . $where;
        return;
    }

    public $not_in_name = [];
    public $not_in_table = [];
    public $not_in_fild = [];

    public function must_not_be_in($table, $fild, $input_name)
    {
        $this->not_in_name[sizeof($this->not_in_name)] = $input_name;
        $this->not_in_table[$input_name] = $table;
        $this->not_in_fild[$input_name] = $fild;
        return $this;
    }

    public $be_in_name = [];
    public $be_in_table = [];
    public $be_in_fild = [];

    public function must_be_in($table, $fild, $input_name)
    {
        $this->be_in_name[sizeof($this->be_in_name)] = $input_name;
        $this->be_in_table[$input_name] = $table;
        $this->be_in_fild[$input_name] = $fild;
        return $this;
    }

    public $after_add_url = "";
    public $after_edit_url = "";
    public $after_delete_url = "";

    public $option_td_include = "";

    public function show()
    {
        //var_dump($this->selectvals);
        if (isset($_GET['action']) == false && $this->alow_add == false) {
            die();
        }
        if (isset($_GET['action']) == false && $this->alow_add == true) {
            if ($this->alow_visit == true) {
                ?>
                <a href="<?php $fl = new filemg();
                echo($fl->getfilename()); ?>?action=show"><input type="button" class="w3-btn w3-blue w3-round w3-margin"
                                                                 value="مشاهده"></a>
                <?php
            }
            echo($this->all);
        } elseif ($_GET['action'] == true) {
            if ($_GET['action'] == "addform" && $this->alow_add == true) {
                if ($this->alow_visit == true) {
                    ?>
                    <a href="<?php $fl = new filemg();
                    echo($fl->getfilename()); ?>?action=show"><input type="button"
                                                                     class="w3-btn w3-blue w3-round w3-margin"
                                                                     value="مشاهده"></a>
                    <?php
                }
                echo($this->all);
            } elseif ($_GET['action'] == "addquery" && $this->alow_add == true) {
                $db = new database();
                for ($i = 0; $i < sizeof($this->formname); $i++) {
                    if ($this->formreq[$i] == 1 && (isset($_POST[$this->formname[$i]]) == false || $_POST[$this->formname[$i]] == "") && $this->formtype[$i] != 4) {
                        $msg = new message();
                        $msg->msgb(" لطفا ورودی " . $this->formtitle[$i] . " را وارد نمایید...");
                        die();
                    } else {
                        //echo($this->formtitle[$i] . " = " . $_POST[$this->formname[$i]]);
                    }
                    if ($this->formtype[$i] == 0) {
                        $thisvar = "'" . $this->sqlstr($_POST[$this->formname[$i]]) . "'";
                        $db->addtoparam($this->formname[$i], $thisvar);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }

                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->be_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }

                    } elseif ($this->formtype[$i] == 1) {
                        $thisplcvar = $this->sqlint($_POST[$this->formname[$i]]);

                        if ($this->formreq[$i] != 1 && (isset($_POST[$this->formname[$i]]) == false || $_POST[$this->formname[$i]] == "") && $this->formtype[$i] != 4) {
                            echo("hi");
                            $thisplcvar = 0;
                        }
                        $db->addtoparam($this->formname[$i], $thisplcvar);
                        //$db->addtoparam($this->formname[$i], $this->sqlint($_POST[$this->formname[$i]]));
                        //$thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        $thisvar = $thisplcvar;
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->not_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 2) {
                        $db->addtoparam($this->formname[$i], $this->sqlint($_POST[$this->formname[$i]]));
                        $thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->be_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 3) {
                        $bitval = $this->sqlint($_POST[$this->formname[$i]]);
                        if ($bitval != 0 && $bitval != 1) {
                            die();
                        }
                        $db->addtoparam($this->formname[$i], $bitval);
                        $thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->not_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 4) {

                        $msg = new message();
                        if ($_FILES[$this->formname[$i]]['size'] == 0 && $this->formreq[$i] == 1) {
                            $msg->msgb("لطفا " . $this->formtitle[$i] . " را وارد نمایید.");
                            die();
                        }

                        $allowedMimes = [
                            'application/pdf',
                            'application/msword',
                            'text/plain',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ];
                        //if ($_FILES[$this->formname[$i]]['type'] != "") {
                        if (in_array($_FILES[$this->formname[$i]]['type'], $allowedMimes)) {
                            if ($_FILES[$this->formname[$i]]['size'] < 6600000) {

                                $newname = "uploads/" . md5(date("Y-m-d h:i:sa")) . $_FILES[$this->formname[$i]]['name'];
                                $newplace = "../" . $newname;
                                move_uploaded_file($_FILES[$this->formname[$i]]['tmp_name'], $newplace);
                                $fsize = $_FILES[$this->formname[$i]]['size'];
                                $thisvar = "'" . $newplace . "'";
                                $db->addtoparam($this->formname[$i], $thisvar);
                            } else {
                                $msg->msgb("حجم فایل " . $this->formtitle[$i] . " بیشتر از 6 مگابایت می باشد.");
                                die();
                            }
                        } else {
                            if ($_FILES[$this->formname[$i]]['type'] == "" && $this->formreq[$i] == 0) {

                            } else {
                                $msg->msgb("فرمت فایل " . $this->formtitle[$i] . " پشتیبانی نمی شود.");
                                die();
                            }
                        }
                        /*} else if ($this->formreq[$i] == true) {
                            $msg->msgb("لطفا " . $this->formtitle[$i] . " را وارد نمایید.");
                            die();
                        }*/
                    }

                }
                for ($i = 0; $i < sizeof($this->int_var_arr); $i++) {
                    if ($this->int_for_add == true) {
                        $db->addtoparam($this->int_var_arr[$i], $this->int_val_arr[$i]);
                    }
                }
                for ($i = 0; $i < sizeof($this->str_var_arr); $i++) {
                    if ($this->str_for_add == true) {
                        $thisval = "'" . $this->str_val_arr[$i] . "'";
                        $db->addtoparam($this->str_var_arr[$i], $thisval);
                    }
                }

                $db->addquery($this->settable, $this->after_add_url);
            } elseif ($_GET['action'] == "show" && $this->alow_visit == true) {
                ?>
                <script>
                    function hidefilter() {
                        if (document.getElementById('filterplc').style.display == '') {
                            document.getElementById('filterplc').style.display = 'none';
                        } else {
                            document.getElementById('filterplc').style.display = '';
                        }
                    }
                </script>
                <a href="<?php $fl = new filemg();
                echo($fl->getfilename()); ?>"><input type="button" class="w3-btn w3-green w3-round w3-margin"
                                                     value="+افزودن"></a>
                <?php
                $have_filter = 0;
                for ($i = 0; $i < sizeof($this->formfilter); $i++) {
                    if ($this->formfilter[$i] == 1) {
                        $have_filter++;
                    }
                }
                if ($have_filter > 0) {
                    ?>
                    <input type="button" class="w3-btn w3-orange w3-round" value="فیلترینگ!"
                           onclick="hidefilter();">
                    <?php
                }
                $this->loadfilter();
                $restbl = "<table border='1' class='w3-table w3-striped' style='width: 100%;'><tr>";
                for ($i = 0; $i < sizeof($this->formtbl); $i++) {
                    if ($this->formtbl[$i] == 1) {
                        $restbl .= "<th class='w3-right-align'>" . $this->formtitle[$i] . "</th>";
                    }
                }
                $restbl .= "<th class='w3-right-align'>عملیات</th>";
                $restbl .= "</tr>";

                $db = new database();
                $fi = "";
                for ($j = 0; $j < sizeof($this->formfilter); $j++) {
                    if ($this->formfilter[$j] == 1) {
                        if (isset($_GET[$this->formname[$j]]) == true) {
                            if ($_GET[$this->formname[$j]] != "") {
                                $item = "";
                                if ($this->formtype[$j] == 0) {
                                    $item = "'" . $this->sqlstr($_GET[$this->formname[$j]]) . "'";
                                }
                                if ($this->formtype[$j] == 1) {
                                    $item = $this->sqlint($_GET[$this->formname[$j]]);
                                }
                                if ($this->formtype[$j] == 2) {
                                    $item = $this->sqlint($_GET[$this->formname[$j]]);
                                }
                                if ($fi == "") {
                                    $fi = " `" . $this->formname[$j] . "` = $item";
                                } else {
                                    $fi .= " and `" . $this->formname[$j] . "` = $item";
                                }
                            }
                        }
                    }
                }
                if ($this->wheresql != "") {
                    if ($fi == "") {
                        $fi = $this->wheresql;
                    } else {
                        $fi .= " and " . $this->wheresql;
                    }
                }
                if ($fi != "") {
                    $fi = " where $fi";
                }
                $sql = "select * from `$this->settable` $fi";
                $db->connect()->query($sql);
                $fl = new filemg();
                while ($fild = mysqli_fetch_assoc($db->res)) {
                    $restbl .= "<tr>";
                    for ($i = 0; $i < sizeof($this->formtbl); $i++) {
                        if ($this->formtbl[$i] == 1) {
                            if ($this->formtype[$i] == 2) {
                                $restbl .= "<td class='w3-right-align'>" . $this->selectvals[$this->formname[$i]][$fild[$this->formname[$i]]] . "</td>";
                            } else {
                                $restbl .= "<td class='w3-right-align'>" . $fild[$this->formname[$i]] . "</td>";
                            }
                        }
                    }
                    $restbl .= "<td class='w3-right-align'>";
                    if ($this->alow_edit == true) {
                        $restbl .= " <a href='" . $fl->getfilename() . "?action=editform&" . $this->setkey . "=" . $fild[$this->setkey] . "'><input type='button' value='ویرایش' class='w3-btn w3-blue w3-round'></a> ";
                    }
                    if ($this->alow_del == true) {
                        $restbl .= " <a href='" . $fl->getfilename() . "?action=deletequery&" . $this->setkey . "=" . $fild[$this->setkey] . "'><input type='button' value='حذف' class='w3-btn w3-red w3-round'></a> ";
                    }
                    if ($this->option_td_include != "") {
                        include($this->option_td_include);
                    }
                    $restbl .= "</td>";
                    $restbl .= "</tr>";
                }
                $restbl .= "</table>";
                echo($restbl);
            } elseif
            ($_GET['action'] == 'editform' && $this->alow_edit == true) {
                if ($this->alow_visit == true) {
                    ?><a href="<?php $fl = new filemg();
                    echo($fl->getfilename()); ?>?action=show"><input type="button"
                                                                     class="w3-btn w3-blue w3-round w3-margin"
                                                                     value="مشاهده"></a><?php
                }
                echo($this->all);
                $setval = $_GET[$this->setkey];
                if ($this->setkey_type == 0) {
                    $setval = $this->sqlstr($setval);
                } elseif ($this->setkey_type == 1) {
                    $setval = $this->sqlint($setval);
                } elseif ($this->setkey_type == 2) {
                    $setval = $this->sqlint($setval);
                    if ($setval != 0 && $setval != 1) {
                        die();
                    }
                }

                $sql = "select * from `$this->settable` where `$this->setkey`='$setval' $this->where_edit";
                $db = new database();
                $db->connect()->query($sql);
                if (mysqli_num_rows($db->res) > 0) {
                    $fild = mysqli_fetch_assoc($db->res);
                    $resscript = "<script>" . PHP_EOL;
                    for ($i = 0; $i < sizeof($this->formname); $i++) {
                        $resscript .= "if(document.getElementsByName(" . '"' . $this->formname[$i] . '"' . ")[0].tagName=='INPUT' && document.getElementsByName(" . '"' . $this->formname[$i] . '"' . ")[0].type!='file'){
                        document.getElementsByName(" . '"' . $this->formname[$i] . '"' . ")[0].value=" . '"' . preg_replace('/\s\s+/', " ", $fild[$this->formname[$i]] . '"') . ";
                    }" . PHP_EOL;
                        $resscript .= "if(document.getElementsByName('" . $this->formname[$i] . "')[0].tagName=='INPUT' && document.getElementsByName('" . $this->formname[$i] . "')[0].type=='file'){
                        document.getElementById('imgfm" . $this->formname[$i] . "').src='" . preg_replace('/\s\s+/', " ", $fild[$this->formname[$i]]) . "';
                    }" . PHP_EOL;
                        $resscript .= "if(document.getElementsByName('" . $this->formname[$i] . "')[0].tagName=='TEXTAREA'){
                        document.getElementsByName('" . $this->formname[$i] . "')[0].value=" . '"' . preg_replace('/\s\s+/', '"' . "+" . "'\\n'" . "+" . '"', $fild[$this->formname[$i]]) . '"' . ";
                    }" . PHP_EOL;
                        $resscript .= "if(document.getElementsByName('" . $this->formname[$i] . "')[0].tagName=='SELECT'){
                        document.getElementsByName('" . $this->formname[$i] . "')[0].value=" . '"' . preg_replace('/\s\s+/', " ", $fild[$this->formname[$i]]) . '"' . ";
                    }" . PHP_EOL;
                        $fl = new filemg();
                        if (is_numeric(strpos($this->form_action, "action=addquery")) == true) {
                            $resscript .= "document.getElementsByTagName('form')[0].action='" . $fl->getfilename() . "?action=editquery&" . $this->setkey . "=" . $setval . "';";
                        }
                    }
                    $resscript .= "</script>";
                    echo($resscript);
                }
            } elseif ($_GET['action'] == "editquery" && $this->alow_edit == true) {
                $db = new database();
                for ($i = 0; $i < sizeof($this->formname); $i++) {

                    if ($this->formreq[$i] == 1 && isset($_POST[$this->formname[$i]]) == false && $this->formtype[$i] != 4) {
                        $msg = new message();
                        $msg->msgb("لطفا ورودی " . $this->formtitle[$i] . " را وارد نمایید...");
                        die();
                    } else {
                    }
                    if ($this->formtype[$i] == 0) {
                        $thisvar = "'" . $this->sqlstr($_POST[$this->formname[$i]]) . "'";
                        $db->addtoedit($this->formname[$i], $thisvar);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->be_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 1) {
                        $thisplcvar = $this->sqlint($_POST[$this->formname[$i]]);

                        if ($this->formreq[$i] != 1 && (isset($_POST[$this->formname[$i]]) == false || $_POST[$this->formname[$i]] == "") && $this->formtype[$i] != 4) {
                            $thisplcvar = 0;
                        }
                        $db->addtoedit($this->formname[$i], $thisplcvar);
                        $thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->not_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 2) {
                        $db->addtoedit($this->formname[$i], $this->sqlint($_POST[$this->formname[$i]]));
                        $thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->be_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 3) {
                        $bitval = $this->sqlint($_POST[$this->formname[$i]]);
                        if ($bitval != 0 && $bitval != 1) {
                            die();
                        }
                        $db->addtoedit($this->formname[$i], $bitval);
                        $thisvar = $this->sqlint($_POST[$this->formname[$i]]);
                        for ($j = 0; $j < sizeof($this->not_in_name); $j++) {
                            if ($this->formname[$i] == $this->not_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->not_in_table[$this->not_in_name[$j]] . "` where `" . $this->not_in_fild[$this->not_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) > 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " تکراری می باشد.");
                                    die();
                                }
                            }
                        }
                        for ($j = 0; $j < sizeof($this->be_in_name); $j++) {
                            if ($this->formname[$i] == $this->be_in_name[$j]) {
                                $sqlcheck = "select * from `" . $this->be_in_table[$this->not_in_name[$j]] . "` where `" . $this->be_in_fild[$this->be_in_name[$j]] . "`=$thisvar";
                                $db2 = new database();
                                $db2->connect()->query($sqlcheck);
                                if (mysqli_num_rows($db2->res) == 0) {
                                    $msg = new message();
                                    $msg->msgb("عبارت " . $this->formtitle[$i] . " موجود نمی باشد.");
                                    die();
                                }
                            }
                        }
                    } elseif ($this->formtype[$i] == 4) {
                        if ($_FILES[$this->formname[$i]]['name'] != null) {

                            $allowedMimes = [
                                'application/pdf',
                                'application/msword',
                                'text/plain',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'image/jpeg',
                                'image/png',
                                'image/gif'
                            ];
                            if (in_array($_FILES[$this->formname[$i]]['type'], $allowedMimes)) {
                                if ($_FILES[$this->formname[$i]]['size'] < 6600000) {

                                    $newname = "uploads/" . md5(date("Y-m-d h:i:sa")) . $_FILES[$this->formname[$i]]['name'];
                                    $newplace = "../" . $newname;
                                    move_uploaded_file($_FILES[$this->formname[$i]]['tmp_name'], $newplace);
                                    $fsize = $_FILES[$this->formname[$i]]['size'];
                                    $thisvar = "'" . $newplace . "'";
                                    $db->addtoedit($this->formname[$i], $thisvar);
                                } else {
                                    msgb("حجم فایل " . $this->formtitle[$i] . " بیشتر از 6 مگابایت می باشد.");
                                }
                            } else {
                                msgb("فرمت فایل " . $this->formtitle[$i] . " پشتیبانی نمی شود.");
                            }
                        }
                    }
                }

                for ($i = 0; $i < sizeof($this->int_var_arr); $i++) {
                    if ($this->int_for_add == true) {
                        $db->addtoedit($this->int_var_arr[$i], $this->int_val_arr[$i]);
                    }
                }
                for ($i = 0; $i < sizeof($this->str_var_arr); $i++) {
                    if ($this->str_for_add == true) {
                        $thisval = "'" . $this->str_val_arr[$i] . "'";
                        $db->addtoedit($this->str_var_arr[$i], $thisval);
                    }
                }

                $keyval = "";
                if ($this->setkey_type == 0) {
                    $keyval = "'" . $this->sqlstr($_GET[$this->setkey]) . "'";
                } elseif ($this->setkey_type == 1) {
                    $keyval = $this->sqlint($_GET[$this->setkey]);
                } elseif ($this->setkey_type == 2) {
                    $keyval = $this->sqlint($_GET[$this->setkey]);
                    if ($keyval != 0 && $keyval != 1) {
                        die();
                    }
                }
                $db->update($this->settable, $this->setkey, $keyval, $this->after_edit_url, $this->where_edit);
            } elseif ($_GET['action'] == "deletequery" && $this->alow_del == true) {
                $db = new database();
                if (isset($_GET[$this->setkey]) == false) {
                    die();
                }
                $id = $_GET[$this->setkey];
                if ($this->setkey_type == 0) {
                    $id = "'" . $this->sqlstr($id) . "'";
                } elseif ($this->setkey_type == 1) {
                    $id = $this->sqlint($id);
                }
                $db->deletequery($this->settable, $this->setkey, $id, $this->after_delete_url, $this->delwhere);
            }
        }
    }

    public function sndform($name, $type, $req, $title, $show_tbl = 0, $filter = 0)
    {
        if (sizeof($this->selects) > 0) {
            $countarray = 0;
            if (sizeof($this->selects) - 1 > 0) {
                $countarray = sizeof($this->selects) - 1;
            }
            $this->selectvals += array($this->selects[$countarray] => $this->sel_val);

        }
        $this->sel_val = [];
        $this->formname[sizeof($this->formname)] = $name;
        $this->formtype[sizeof($this->formtype)] = $type;
        $this->formreq[sizeof($this->formreq)] = $req;
        $this->formtitle[sizeof($this->formtitle)] = $title;
        $this->formtbl[sizeof($this->formtbl)] = $show_tbl;
        $this->formfilter[sizeof($this->formfilter)] = $filter;
        return $this;
    }

    public function loadfilter()
    {
        $countfilter = 0;
        //$this->all = "";
        $fm = new makeform();
        for ($i = 0; $i < sizeof($this->formfilter); $i++) {
            if ($this->formfilter[$i] == 1) {
                $countfilter++;
                if ($this->formtype[$i] == 0) {
                    $fm->label($this->formtitle[$i], "w3-text-green")
                        ->input()
                        ->inpclasses("w3-input w3-border")
                        ->inptype("text")
                        ->inpid($this->formname[$i])
                        ->inpname($this->formname[$i]);
                    $fm->end();
                } elseif ($this->formtype[$i] == 1) {
                    $fm->label($this->formtitle[$i], "w3-text-green")
                        ->input()
                        ->inptype("number")
                        ->inpclasses("w3-input w3-border")
                        ->inpid($this->formname[$i])
                        ->inpname($this->formname[$i]);
                    $fm->end();
                } elseif ($this->formtype[$i] == 2) {
                    $fm->label($this->formtitle[$i], "w3-text-green")
                        ->select()
                        ->selectclasses("w3-select w3-border")
                        ->selectname($this->formname[$i])
                        ->selectid($this->formname[$i]);
                    $db = new database();
                    $disfild = $this->formname[$i];
                    $db_table = $this->settable;
                    if ($this->wheresql != "") {
                        $sql = "select DISTINCT(`$disfild`) from `$db_table` where $this->wheresql";
                    } else {
                        $sql = "select DISTINCT(`$disfild`) from `$db_table`";
                    }
                    $db->connect()->query($sql);
                    $fm->selectaddval("", "انتخاب مقدار");
                    while ($fild = mysqli_fetch_assoc(($db->res))) {
                        $fm->selectaddval($fild[$this->formname[$i]], $this->selectvals[$this->formname[$i]][$fild[$this->formname[$i]]]);
                    }
                    $fm->end();
                }
            }
        }
        if ($countfilter > 0) {
            $fm->input()
                ->inptype("submit")
                ->inpclasses("w3-btn w3-green w3-round w3-margin")
                ->inpval("جستجو")
                ->end();
            $fm->input()
                ->inptype("hidden")
                ->inpname("action")
                ->inpval("show")
                ->end();
            $fm->addform("get", "?action=show")->end();
            echo("<div id='filterplc' style='display: none;'>" . $fm->all . "</div>");
            //$fm->show();
        }
    }

    public function sqlstr($out)
    {
        if (is_array($out) == true) {
            die();
        }
        $out = str_replace("'", "&#" . ord("'") . ";", $out);
        $out = str_replace("*", "&#" . ord("*") . ";", $out);
        $out = str_replace(",", "&#" . ord(",") . ";", $out);
        $out = str_replace('"', "&#" . ord('"') . ";", $out);
        $out = str_replace("&", "&#" . ord("&") . ";", $out);
        $out = str_replace("%", "&#" . ord("%") . ";", $out);
        $out = str_replace("(", "&#" . ord("(") . ";", $out);
        $out = str_replace(")", "&#" . ord(")") . ";", $out);
        //$out = str_replace("_", "&#" . ord("_") . ";", $out);
        $out = str_replace('\\', "&#" . ord("\\") . ";", $out);
        $out = str_replace('|', "&#" . ord("|") . ";", $out);
        $out = str_replace('<', "&#" . ord("<") . ";", $out);
        $out = str_replace('>', "&#" . ord(">") . ";", $out);
        return $out;
    }

    public function sqlint($out)
    {
        if (is_array($out) == true) {
            die();
        }
        if ($out != null || $out != "") {
            if (is_numeric($out) == false) {
                die();
            } else {
                return $out;
            }
        }
    }

    public $int_val_arr = [];
    public $int_var_arr = [];
    public $int_for_add = [];
    public $int_for_edit = [];

    public function set_int_val($varname, $val, $for_add = true, $for_edit = true)
    {
        $this->int_var_arr[sizeof($this->int_var_arr)] = $varname;
        $this->int_val_arr[sizeof($this->int_val_arr)] = $val;
        $this->int_for_add[sizeof($this->int_for_add)] = $for_add;
        $this->int_for_edit[sizeof($this->int_for_edit)] = $for_edit;
    }

    public $str_val_arr = [];
    public $str_var_arr = [];
    public $str_for_add = [];
    public $str_for_edit = [];

    public function set_str_val($varname, $val, $for_add = true, $for_edit = true)
    {
        $this->str_var_arr[sizeof($this->str_var_arr)] = $varname;
        $this->str_val_arr[sizeof($this->str_val_arr)] = $val;
        $this->str_for_add[sizeof($this->str_for_add)] = $for_add;
        $this->str_for_edit[sizeof($this->str_for_edit)] = $for_edit;
    }

    public function fast_number_input($lbl, $inpname, $inpid = "", $req = 0, $show_in_tbl = 0, $filter = 0)
    {
        if ($inpid == "") {
            $inpid = $inpname;
        }
        $this->label($lbl, "w3-text-green")
            ->input()
            ->inptype("number")
            ->inpname($inpname)
            ->inpid($inpid)
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform($inpname, 1, $req, $lbl, $show_in_tbl, $filter);
    }

    public function fast_string_input($lbl, $inpname, $inpid = "", $req = 0, $show_in_tbl = 0, $filter = 0)
    {
        if ($inpid == "") {
            $inpid = $inpname;
        }
        $this->label($lbl, "w3-text-green")
            ->input()
            ->inptype("text")
            ->inpname($inpname)
            ->inpid($inpid)
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform($inpname, 0, $req, $lbl, $show_in_tbl, $filter);
    }

    public function fast_password_input($lbl, $inpname, $inpid = "")
    {
        if ($inpid == "") {
            $inpid = $inpname;
        }
        $this->label($lbl, "w3-text-green")
            ->input()
            ->inptype("password")
            ->inpname($inpname)
            ->inpid($inpid)
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform($inpname, 0, 1, $lbl);
    }

    public function fast_textarea($lbl, $inpname, $inpid = "", $req = 0, $show_in_tbl = 0, $filter = 0)
    {
        if ($inpid == "") {
            $inpid = $inpname;
        }
        $this->label($lbl, "w3-text-green")
            ->texarea()
            ->areaname($inpname)
            ->areaid($inpid)
            ->areaclasses("w3-input w3-border")
            ->end()
            ->sndform($inpname, 0, $req, $lbl, $show_in_tbl, $filter);
    }

    public function submit()
    {
        $this->input()
            ->inptype("submit")
            ->inpval("ثبت")
            ->inpclasses("w3-btn w3-green w3-margin w3-round")
            ->end();
    }


}

?>