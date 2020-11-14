<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 9/25/2020
 * Time: 10:18 PM
 */
class mobile_input
{
    function json_msg($msg)
    {
        echo('{"msg":"' . $msg . '"}');
        return $this;
    }

    private $name;
    private $title;
    private $important;

    function set_name($name)
    {
        $this->name = $name;
        return $this;
    }

    function set_title($title)
    {
        $this->title = $title;
        return $this;
    }

    function set_important($important = false)
    {
        $this->important = $important;
        return $this;
    }

    function post_str()
    {
        $name = $this->name;
        $title = $this->title;
        $important = $this->important;
        $fm = new makeform();
        if ($important == true) {
            if (isset($_POST[$name]) == false) {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            if ($_POST[$name] == "") {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            $out_str = $fm->sqlstr($_POST[$name]);
            return $out_str;
        } else {
            $out_str = "";
            if (isset($_POST[$name]) == true) {
                $out_str = $fm->sqlstr($_POST[$name]);
            }
            return $out_str;
        }


    }

    function get_str()
    {
        $name = $this->name;
        $title = $this->title;
        $important = $this->important;
        $fm = new makeform();
        if ($important == true) {
            if (isset($_GET[$name]) == false) {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            if ($_GET[$name] == "") {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            $out_str = $fm->sqlstr($_GET[$name]);
            return $out_str;
        } else {
            $out_str = "";
            if (isset($_GET[$name]) == true) {
                $out_str = $fm->sqlstr($_GET[$name]);
            }
            return $out_str;
        }


    }

    function post_int()
    {
        $name = $this->name;
        $title = $this->title;
        $important = $this->important;
        $fm = new makeform();
        if ($important == true) {
            if (isset($_POST[$name]) == false) {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            if ($_POST[$name] == "") {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            return $fm->sqlint($_POST[$name]);
        } else {
            $out_int = "";
            if (isset($_POST[$name]) == true) {
                $out_int = $fm->sqlint($_POST[$name]);
            }
            return $out_int;
        }
    }

    function get_int()
    {
        $name = $this->name;
        $title = $this->title;
        $important = $this->important;
        $fm = new makeform();
        if ($important == true) {
            if (isset($_GET[$name]) == false) {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            if ($_GET[$name] == "") {
                $this->json_msg("لطفا مقدار " . $title . " را وارد نمایید.");
                die();
            }
            return $fm->sqlint($_GET[$name]);
        } else {
            $out_int = "";
            if (isset($_GET[$name]) == true) {
                $out_int = $fm->sqlint($_GET[$name]);
            }
            return $out_int;
        }
    }

    function login($table, $user_fild, $pass_fild)
    {
        $this->set_name("user")->set_title("نام کاربری")->set_important(true);
        $user = $this->post_str($user_fild);
        $this->set_name("pass")->set_title("کلمه عبور")->set_important(true);
        $pass = $this->post_str($pass_fild);
        $sql = "select * from `$table` where `$user_fild`='$user' and `$pass_fild`='$pass'";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) > 0) {
            $this->json_msg("ok_aut");
        } else {
            $this->json_msg("err_aut");
        }
    }

    function islogin($table, $user_fild, $pass_fild)
    {
        $this->set_name("user")->set_title("نام کاربری")->set_important(true);
        $user = $this->post_str($user_fild);
        $this->set_name("pass")->set_title("کلمه عبور")->set_important(true);
        $pass = $this->post_str($pass_fild);
        $sql = "select * from `$table` where `$user_fild`='$user' and `$pass_fild`='$pass'";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 0) {
            $this->json_msg("err_aut");
            die();
        }
    }

    function islogin_get($table, $user_fild, $pass_fild)
    {
        $this->set_name("user")->set_title("نام کاربری")->set_important(true);
        $user = $this->get_str($user_fild);
        $this->set_name("pass")->set_title("کلمه عبور")->set_important(true);
        $pass = $this->get_str($pass_fild);
        $sql = "select * from `$table` where `$user_fild`='$user' and `$pass_fild`='$pass'";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 0) {
            $this->json_msg("err_aut");
            die();
        }
    }

    function check_token($tbl, $mobile, $token)
    {
        $mob = $this->set_name($mobile)->set_title("شماره تلفن همراه")->set_important(true)->post_str();
        $tk = $this->set_name($token)->set_title("توکن")->set_important(true)->post_str();
        $sql = "select * from `$tbl` where `$mobile`='$mob' AND `$token`='$tk' order by id DESC limit 0,1";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 0) {
            $this->json_msg("شماره تلفن همراه و یا توکن وارد شده اشتباه می باشند.");
            die();
        }
    }
}

?>