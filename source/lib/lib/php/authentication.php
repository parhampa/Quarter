<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/29/2020
 * Time: 7:38 AM
 */
class loginpg
{
    public $inputclass = "";
    public $btnsubmit = "";
    public $btnstyl = "";
    public $regbtnstyl = "";
    public $onclickreg = "";
    public $inside_txt = false;

    public function loginform($btnreg = 0)
    {
        $fm = new makeform();
        $fm->alow_del = false;
        $fm->alow_edit = false;
        $fm->alow_visit = false;
        $fm->alow_add = true;
        $fm->all .= '<div class="form-group">';
        if ($this->inside_txt == false) {
            $fm->label("نام کاربری");
        }
        $fm->input()
            ->inpid("user")
            ->inpname("user")
            ->inptype("text");
        if ($this->inside_txt == true) {
            $fm->inpplaceholder("نام کاربری");
        }
        if ($this->inputclass == "") {
            $fm->inpclasses("w3-input w3-border");
        } else {
            $fm->inpclasses($this->inputclass);
        }
        $fm->end();
        $fm->all .= '</div>';
        $fm->all .= '<div class="form-group">';
        if ($this->inside_txt == false) {
            $fm->label("کلمه عبور");
        }
        $fm->input()
            ->inpname("pass")
            ->inpid("pass");
        if ($this->inside_txt == true) {
            $fm->inpplaceholder("کلمه عبور");
            $fm->inpstyles("margin-top:5px;");
        }

        if ($this->inputclass == "") {
            $fm->inpclasses("w3-input w3-border");
        } else {
            $fm->inpclasses($this->inputclass);
        }
        $fm->inptype("password")
            ->end();
        $fm->all .= '</div>';
        $fm->all .= "<div style='width: 100%; text-align: center;'>";
        $fm->CSRF_token();
        if ($this->btnsubmit == "") {
            $fm->input()
                ->inptype("submit")
                ->inpval("ورود")
                ->inpid("logbtn")
                ->inpclasses("w3-btn w3-green w3-round w3-margin")
                ->inpstyles($this->btnstyl)
                ->end();
        } else {
            $fm->all .= $this->btnsubmit;
        }
        if ($btnreg == 1) {
            $fm->input()
                ->inptype("buttom")
                ->inpval("ثبت نام")
                ->inpid("regbtn")
                ->inpclasses("w3-btn w3-round w3-pink")
                ->inpstyles($this->regbtnstyl)
                ->onclick($this->onclickreg)
                ->end();
        }
        $fm->all .= "</div>";
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

        if (isset($_POST['csrf_token']) == false) {
            $msg = new message();
            $msg->msgb("کاربر گرامی درخواست شما قابل اجرا نمی باشد.");
            die();
        } else if (isset($_SESSION['csrf_token']) == false) {
            //die($_SESSION['csrf_token']);
            $msg = new message();
            $msg->msgb("کاربر گرامی درخواست شما قابل اجرا نمی باشد.");
            die();
        } else {
            if ($_SESSION['csrf_token'] != $_POST['csrf_token']) {
                $msg = new message();
                $msg->msgb("کاربر گرامی درخواست شما قابل اجرا نمی باشد.");
                die();
            }
        }

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
            //$ms->msg("شما با موفقیت وارد شدید", $this->after_login_page);
            ?>
            <script>
                location.replace("<?php echo($this->after_login_page); ?>")
            </script>
            <?php
        } else {
            $ms->msgb("نام کاربری و یا کلمه عبور اشتباه می باشد.");
            die();
        }
    }

    public function showlogin($login_db, $login_user, $login_pass, $after_login_page, $regbtn = 0)
    {
        $this->login_db = $login_db;
        $this->login_user = $login_user;
        $this->login_pass = $login_pass;
        $this->after_login_page = $after_login_page;
        if (isset($_GET['action']) == false) {
            $this->loginform($regbtn);
        } elseif ($_GET['action'] == "loginquery") {
            $this->loginquery();
        } else {
            $this->loginform();
        }
    }
}

?>