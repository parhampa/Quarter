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
}

?>