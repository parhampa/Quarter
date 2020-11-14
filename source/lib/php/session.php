<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 10/14/2020
 * Time: 4:14 AM
 */
class ses
{
    public function check_session($tbl, $ses_name, $active_name, $where, $pm)
    {
        $msg = new message();
        if (isset($_SESSION[$ses_name]) == false) {
            $msg->msg($pm, $where);
            die();
        }
        $sesval = $_SESSION[$ses_name];
        $sql = "select * from `$tbl` where `$ses_name`='$sesval' AND `$active_name`=1";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 0) {
            $msg->msg($pm, $where);
            die();
        }
    }
}

?>