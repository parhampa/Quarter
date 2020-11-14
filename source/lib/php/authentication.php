<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/29/2020
 * Time: 7:38 AM
 */
class loginpg
{

    public function loginform()
    {
        $fm = new makeform();
        $fm->alow_del = false;
        $fm->alow_edit = false;
        $fm->alow_visit = false;
        $fm->alow_add = true;
        $fm->label("نام کاربری", "w3-text-green")
            ->input()
            ->inpid("user")
            ->inpname("user")
            ->inpclasses("w3-input w3-border")
            ->inptype("text")
            ->end();
        $fm->label("کلمه عبور", "w3-text-green")
            ->input()
            ->inpname("pass")
            ->inpid("pass")
            ->inpclasses("w3-input w3-border")
            ->inptype("password")
            ->end();
        $fm->input()
            ->inptype("submit")
            ->inpval("ورود")
            ->inpclasses("w3-btn w3-green w3-round w3-margin")
            ->end();
        $fm->addform("post", "?action=loginquery")->end();
        $fm->show();
    }

    public $login_db = "";
    public $login_user = "";
    public $login_pass = "";

    public $after_login_page = "";

    public function loginquery()
    {
        $fm = new makeform();
        $fm->alow_del = false;
        $fm->alow_edit = false;
        $fm->alow_visit = false;
        $fm->alow_add = false;
        $ms = new message();
        if (isset($_POST['user']) == false) {
            $ms->msgb("لطفا نام کاربری را وارد نمایید.");
            die();
        }
        $user = $fm->sqlstr($_POST['user']);
        if (trim($user) == "") {
            $ms->msgb("لطفا نام کاربری را وارد نمایید.");
            die();
        }
        if (isset($_POST['pass']) == false) {
            $ms->msgb("لطفا کلمه عبور را وارد نمایید.");
            die();
        }
        $pass = $fm->sqlstr($_POST['pass']);
        if (trim($pass) == "") {
            $ms->msgb("لطفا کلمه عبور را وارد نمایید.");
            die();
        }
        $sql = "select * from `" . $this->login_db . "` where `" . $this->login_user . "`='$user' and `" . $this->login_pass . "`='$pass'";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) == 1) {
            $_SESSION[$this->login_user] = $user;
            $ms->msg("شما با موفقیت وارد شدید", $this->after_login_page);
        } else {
            $ms->msgb("نام کاربری و یا کلمه عبور اشتباه می باشد.");
            die();
        }
    }

    public function showlogin($login_db, $login_user, $login_pass, $after_login_page)
    {
        $this->login_db = $login_db;
        $this->login_user = $login_user;
        $this->login_pass = $login_pass;
        $this->after_login_page = $after_login_page;
        if (isset($_GET['action']) == false) {
            $this->loginform();
        } elseif ($_GET['action'] == "loginquery") {
            $this->loginquery();
        } else {
            $this->loginform();
        }
    }
}

?>