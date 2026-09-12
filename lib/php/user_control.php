<?php

class user_control
{
    public function save_count()
    {
        $ip = str_replace(".", " ", $_SERVER['REMOTE_ADDR']);
        $fm = new makeform();
        $ip = $fm->sqlstr($ip);
        $username = "no no username";
        $country = "nashenas";
        $tarikh = date("Y-m-d");
        $sql = "select * from `users_ip` where `ip`='$ip' and `tarikh`='$tarikh'";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) > 0) {
            $fild = mysqli_fetch_assoc($db->res);
            $pages = $fild['pages'];
            $pages = $pages + 1;

            $sql = "update `users_ip` set `pages`=$pages where `ip`='$ip' and `tarikh`='$tarikh'";
            $db = new database();
            $db->connect()->query($sql);
        } else {
            $sql = "insert into `users_ip` (`ip`,`username`,`country`,`tarikh`,`pages`) values ('$ip','$username','$country','$tarikh',1)";
            $db = new database();
            $db->connect()->query($sql);

        }

    }

    public function get_today_ip_count()
    {
        $tarikh = date("Y-m-d");
        $sql = "select `id` from `users_ip` where `tarikh`='$tarikh'";
        $db = new database();
        $db->connect()->query($sql);

        return mysqli_num_rows($db->res);
    }

    public function get_yesterday_ip_count()
    {
        $newtarikh = date("Y-m-d");
        $dt = new date_man();
        $tarikh = $dt->getPreviousDay($newtarikh);
        $sql = "select `id` from `users_ip` where `tarikh`='$tarikh'";
        $db = new database();
        $db->connect()->query($sql);

        return mysqli_num_rows($db->res);
    }

    public function get_your_date_ip_count($your_date)
    {
        $dt = new date_man();
        $tarikh = $dt->getPreviousDay_from_your_day($your_date);
        $sql = "select `id` from `users_ip` where `tarikh`='$tarikh'";
        $db = new database();
        $db->connect()->query($sql);

        return mysqli_num_rows($db->res);
    }
}

$uc = new user_control();
$uc->save_count();

?>