<?php
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
?>
<!DOCTYPE html>
<html>
<title>تعریف کاربر مدیر</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link href="../fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet">
<script src="../lib/js/jquery.js"></script>
<script src="js/fnuser.js"></script>
<script src="js/modal.js"></script>
<link href="bootstrap-5.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/new.css">
<?php
include("calhead.php");
?>
<body style="direction: rtl;">

<?php include("top.php"); ?>
<?php include("nav.php"); 

        $fm = new makeform();
        $fm->set_tbl_key("admin_user", "username", 0, "تعریف مدیریت کاربران");
        $fm->CSRF_token();
        $fm->label("نام کاربری", "w3-text-green")
            ->input()
            ->inpname("username")
            ->inpid("username")
            ->inptype("text")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("username", 0, 1, "نام کاربری", 1, 1);
        $fm->label("کلمه عبور", "w3-text-green")
            ->input()
            ->inptype("password")
            ->inpname("pass")
            ->inpid("pass")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("pass", 0, 1, "کلمه عبور");
        $fm->label("نام", "w3-text-green")
            ->input()
            ->inpname("name")
            ->inpid("name")
            ->inptype("text")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("name", 0, 1, "نام", 1, 1);
        $fm->label("نام خانوادگی", "w3-text-green")
            ->input()
            ->inpname("family")
            ->inpid("family")
            ->inptype("text")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("family", 0, 1, "نام خانوادگی", 1, 1);
        $fm->label("شماره تماس", "w3-text-green")
            ->input()
            ->inpname("tel")
            ->inpid("tel")
            ->inptype("number")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("tel", 1, 1, "شماره تماس", 1, 1);
        $fm->label("ایمیل", "w3-text-green")
            ->input()
            ->inpname("email")
            ->inpid("email")
            ->inptype("text")
            ->inpclasses("w3-input w3-border")
            ->end()
            ->sndform("email", 0, 1, "ایمیل", 1, 1);
        $fm->label("وضعیت", "w3-text-green")
            ->select()
            ->selectname("active")
            ->selectid("active")
            ->selectaddval(1, "فعال")
            ->selectaddval(0, "غیر فعال")
            ->selectclasses("w3-select w3-border")
            ->end()
            ->sndform("active", 3, 1, "وضعیت", 1, 1);
        $fm->input()
            ->inptype("submit")
            ->inpval("ثبت")
            ->inpclasses("w3-green w3-btn w3-round")
            ->end();
        $fm->addform();
        $fm->show();

include("footer.php");
?>
</body>
</html>