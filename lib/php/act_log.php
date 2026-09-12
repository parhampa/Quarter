<?php

class act_log
{
    public function add($user, $user_type, $file_name, $place_title, $action, $action_title, $tbl, $key_name, $key_type, $key_var, $rec_title)
    {
        $act_date = date("Y-m-d");
        $mili = round(microtime(true) * 1000);
        $sql = "insert into `act_log` (`user`,`user_type`,`file_name`,`place_title`,`action`,`action_title`,`tbl`,`key_name`,`key_type`,`key_var`,`rec_title`,`act_date`,`mili`)
                                values ('$user','$user_type','$file_name','$place_title','$action','$action_title','$tbl','$key_name','$key_type','$key_var','$rec_title','$act_date',
                                        '$mili')";
        //die($sql);
        $db = new database();
        $db->connect()->query($sql);

    }
}

?>