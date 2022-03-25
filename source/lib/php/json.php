<?php

class makejs
{
    private $tbl_name;
    private $tbl_id;
    private $tbl_title;
    private $where;

    public function set_tbl($tbl)
    {
        $this->tbl_name = $tbl;
        return $this;
    }

    public function set_id($id)
    {
        $this->tbl_id = $id;
        return $this;
    }

    public function set_title($title)
    {
        $this->tbl_title = $title;
        return $this;
    }

    public function set_where($where)
    {
        $this->where = $where;
        return $this;
    }

    public function select_info()
    {
        $db = new database();
        if ($this->where != "") {
            $sql = "select * from `" . $this->tbl_name . "` where " . $this->where;
        } else {
            $sql = "select * from `" . $this->tbl_name . "`";
        }
        $db->connect()->query($sql);
        $result = "";
        while ($fild = mysqli_fetch_assoc($db->res)) {
            $result .= "<option value='" . $fild[$this->tbl_id] . "'>" . $fild[$this->tbl_title] . "</option>";
        }
        echo($result);
    }


    /////////////////json database
    private $jsres = "";
    private $full_json = "";

    public function add_single_to_js($varname, $varval)
    {
        $tmpjs = '"' . $varname . '":"' . $varval . '"';
        if ($this->jsres != "") {
            $this->jsres .= "," . $tmpjs;
        } else {
            $this->jsres = $tmpjs;
        }
        return $this;
    }

    public function ad_singles()
    {
        if ($this->full_json != "") {
            $this->full_json .= "," . $this->jsres;
        } else {
            $this->full_json = $this->jsres;
        }
    }

    private $json_objects = "";

    public function make_object()
    {
        $tmp = "{" . $this->jsres . "}";
        if ($this->json_objects != "") {
            $this->json_objects .= "," . $tmp;
        } else {
            $this->json_objects = $tmp;
        }
        $this->jsres = "";
        return $this;
    }

    public function add_objects($name)
    {
        $tmp = '"' . $name . '":[' . $this->json_objects . ']';
        if ($this->full_json != "") {
            $this->full_json .= "," . $tmp;
        } else {
            $this->full_json = $tmp;
        }
        $this->json_objects = "";
    }

    public function endjson()
    {
        $this->full_json = "{" . $this->full_json . "}";
        return $this;
    }


}

?>