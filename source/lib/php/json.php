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

    public function cleanTXT($data)
    {
        $fm = new makeform();
        $newdata = preg_replace('/\s\s+/', " ", preg_replace("/<br>|\n/", " ", $data));
        $newdata = str_replace('"', "'", $newdata);
        return str_replace('&#34;', "'", $newdata);
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
    public $full_json = "";

    public function add_single_to_js($varname, $varval)
    {
        $tmpjs = '"' . $varname . '":"' . preg_replace('/\s\s+/', " ", preg_replace("/<br>|\n/", " ", $varval)) . '"';
        if ($this->jsres != "") {
            $this->jsres .= "," . $tmpjs;
        } else {
            $this->jsres = $tmpjs;
        }
        return $this;
    }

    public function add_singles()
    {
        if ($this->full_json != "") {
            $this->full_json .= "," . $this->jsres;
        } else {
            $this->full_json = $this->jsres;
        }
        $this->jsres = "";
        return $this;
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
        return $this;
    }

    public function endjson()
    {
        $this->full_json = "{" . $this->full_json . "}";
        return $this;
    }

    private $json_sql = "";

    public function set_sql($sql)
    {
        $this->json_sql = $sql;
        return $this;
    }

    private $fildnames = [];

    public function add_fild($name)
    {
        $this->fildnames[sizeof($this->fildnames)] = $name;
        return $this;
    }

    public function select_single()
    {
        $db = new database();
        $db->connect()->query($this->json_sql);
        //var_dump($db);
        if (mysqli_num_rows($db->res) == 1) {
            $fild = mysqli_fetch_assoc($db->res);
            for ($i = 0; $i < sizeof($this->fildnames); $i++) {
                $this->add_single_to_js($this->fildnames[$i], $fild[$this->fildnames[$i]]);
            }
            $this->add_singles();
        }
        /*else{
           in ghesmat ro hatman tasmim begir che konim
        }*/
        $this->fildnames = [];
        return $this;
    }

    public function select_multi($name)
    {
        $db = new database();
        $db->connect()->query($this->json_sql);
        if (mysqli_num_rows($db->res) != 0) {
            while ($fild = mysqli_fetch_assoc($db->res)) {
                for ($i = 0; $i < sizeof($this->fildnames); $i++) {
                    $this->add_single_to_js($this->fildnames[$i], $fild[$this->fildnames[$i]]);
                }
                $this->make_object();
            }
        }
        $this->add_objects($name);
        $this->fildnames = [];
        return $this;
    }

    public function show()
    {
        echo($this->full_json);
        return $this;
    }

}

/*$js = new makejs();
$js->set_sql("select * from `asnaf` where `id`=2")
    ->add_fild("title")
    ->add_fild("pic1")
    ->select_single()
    ->set_sql("select * from `asnaf`")
    ->add_fild("id")
    ->add_fild("title")
    ->select_multi("more")
    ->endjson()
    ->show();*/
?>