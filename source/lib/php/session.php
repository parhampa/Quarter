<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 10/14/2020
 * Time: 4:14 AM
 */
class ses
{
    public function check_session($tbl, $ses_name, $active_name, $where, $pm, $showpm = 0)
    {
        $msg = new message();
        if (isset($_SESSION[$ses_name]) == false) {
            if ($showpm == 0) {
                //$msg->msg($pm, $where);
                ?>
                <script>
                    location.replace("<?php echo($where); ?>")
                </script>
                <?php
            } else {
                ?>
                <script>
                    location.replace("<?php echo($where); ?>")
                </script>
                <?php
            }
            die();
        }
        $sesval = $_SESSION[$ses_name];
        $sql = "select * from `$tbl` where `$ses_name`='$sesval' AND `$active_name`=1";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 0) {
            if ($showpm == 0) {
                $msg->msg($pm, $where);
            } else {
                ?>
                <script>
                    location.replace("<?php echo($where); ?>")
                </script>
                <?php
            }
            die();
        }
    }
}

?>