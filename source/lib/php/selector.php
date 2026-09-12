<?php

class selector
{
    public function select_data($table, $id, $title, $where = "", $zerodata = "", $title2 = "", $title3 = "")
    {
        if ($zerodata != "") {
            ?>
            <option value="0"><?php echo($zerodata); ?></option><?php
        }
        $sql = "select * from `$table` $where ";
        $db = new database();
        $db->connect()->query($sql);
        while ($fild = mysqli_fetch_assoc($db->res)) {
            $titlefull = trim($fild[$title] . " " . $fild[$title2] . " " . $fild[$title3]);
            ?>
            <option value="<?php echo($fild[$id]); ?>"><?php echo($titlefull); ?></option><?php
        }
        return $this;
    }
}

?>