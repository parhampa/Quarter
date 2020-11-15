<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/3/2020
 * Time: 2:06 AM
 */
class database
{
    public $connection = "";
    public $res = "";

    public $addparam = "";
    public $addvalue = "";

    public function connect()
    {
        $this->connection = mysqli_connect($GLOBALS['host'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['database']);
        if (!$this->connection) {
            echo("بانک اطلاعاتی در دسترس نیست!!!");
            die();
        }
        return $this;
    }

    public function query($sql)
    {
        //die($sql);
        $this->res = mysqli_query($this->connection, $sql);
        if (!$this->res) {
            echo("خطا در اجرای کوئری!!!");
            die($sql);
        }
        return $this;
    }

    public function addtoparam($param, $val)
    {
        if ($this->addparam != "") {
            $this->addparam .= ",`" . $param . "`";
            $this->addvalue .= "," . $val;
        } else {
            $this->addparam = "`" . $param . "`";
            $this->addvalue = $val;
        }
        return $this;
    }

    public function addquery($table, $afterquery = "", $return_res = false)
    {
        $sql = "insert into `$table` ($this->addparam) VALUES ($this->addvalue)";

        $this->connect()->query($sql);
        $msg = new message();
        $fl = new filemg();
        if ($return_res != true) {
            if ($afterquery == "") {
                $msg->msg("عملیات با موفقیت انجام شد.", $fl->getfilename() . "?action=show");
            } else {
                $msg->msg("عملیات با موفقیت انجام شد.", $afterquery);
            }
        }
        $this->addparam = "";
        $this->addvalue = "";
        return $this;
    }

    public function deletequery($tbl, $key, $val, $after_delete_url = "")
    {
        $sql = "delete from `$tbl` where `$key`=$val";
        $this->connect()->query($sql);
        $fl = new filemg();
        $msg = new message();
        if ($after_delete_url == "") {
            $msg->msg("عملیات با موفقیت انجام شد.", $fl->getfilename() . "?action=show");
        } else {
            $msg->msg("عملیات با موفقیت انجام شد.", $after_delete_url);
        }
        //echo("عملیات با موفقیت انجام شد.");
        return $this;
    }

    public $editparam = "";

    public function addtoedit($param, $value)
    {
        if ($this->editparam == "") {
            $this->editparam = "`$param`=$value";
        } else {
            $this->editparam .= ",`$param`=$value";
        }
        return $this;
    }

    public function update($table, $key, $val, $url = "", $where = "")
    {
        if ($where == "") {
            $sql = "update `$table` set $this->editparam where `$key`=$val";
        } else {
            $sql = "update `$table` set $this->editparam $where";
        }
        $this->connect()->query($sql);
        $msg = new message();
        $fl = new filemg();
        if ($url == "") {
            $msg->msg("عملیات با موفقیت انجام شد...", $fl->getfilename() . "?action=show");
        } else {
            $msg->msg("عملیات با موفقیت انجام شد...", $url);
        }
        return $this;
    }

}

//$db = new database();
//$db->addtoparam("user", "'ali'")->addtoparam("pass", "'1234'")->addtoparam("age", "18")->addquery("tbl1");
//$db->deletequery('tbl1', 'id', "1");
//$db->addtoedit('user', 'ali')->update('tbl1', 'id', '2');
?>