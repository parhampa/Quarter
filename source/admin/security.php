<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/25/2020
 * Time: 4:01 PM
 */
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
?>
<!DOCTYPE html>
<html>
<title>تغییر رمز عبور</title>
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
<?php include("nav.php"); ?>
<div class="w3-white w3-padding-large w3-round-medium w3-right" style="width: 100%;">
    <div id="profileplc">
    </div>
    <script>
        placeid = "profileplc";

        label.title = "کلمه عبور پیشین";
        label.classes = "w3-text-green";
        make_label();
        input.name = "pass";
        input.id = "pass";
        input.type = "password";
        input.classes = "w3-input w3-border datasender";
        makeinput();

        label.title = "کلمه عبور جدید";
        label.classes = "w3-text-green";
        make_label();
        input.name = "newpass";
        input.id = "newpass";
        input.type = "password";
        input.classes = "w3-input w3-border datasender";
        makeinput();

        label.title = "تکرار کلمه عبور جدید";
        label.classes = "w3-text-green";
        make_label();
        input.name = "newpass2";
        input.id = "newpass2";
        input.type = "password";
        input.classes = "w3-input w3-border datasender";
        makeinput();


        fastbtn("اعمال تغییرات", "snddata()");


        function snddata() {
            postobj.send_type = "post";
            postobj.post_url = "security_edit.php";
            postobj.after_success = function (data) {
                var resjs = JSON.parse(data);
                alert(resjs.msg);
                if (resjs.mcode == 1) {
                    location.replace("logout.php");
                }
            }
            res_obj_postdata("datasender");
        }
    </script>
</div>
<!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>