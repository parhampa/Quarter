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
<title>پروفایل</title>
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

        <?php
        $thisuser = $_SESSION['username'];
        $sqlt = "select * from `admin_user` where `username`='$thisuser'";
        $dbt = new database();
        $dbt->connect()->query($sqlt);
        $fildt = mysqli_fetch_assoc($dbt->res);
        ?>

        label.title = "نام";
        label.classes = "w3-text-green";
        make_label();
        input.name = "name";
        input.id = "name";
        input.type = "text";
        input.classes = "w3-input w3-border datasender";
        input.values = "<?php echo($fildt['name']); ?>";
        makeinput();

        label.title = "نام خانوادگی";
        label.classes = "w3-text-green";
        make_label();
        input.name = "family";
        input.id = "family";
        input.type = "text";
        input.classes = "w3-input w3-border datasender";
        input.values = "<?php echo($fildt['family']); ?>";
        makeinput();

        label.title = "شماره تلفن همراه";
        label.classes = "w3-text-green";
        make_label();
        input.name = "mob";
        input.id = "mob";
        input.type = "text";
        input.classes = "w3-input w3-border datasender";
        input.values = "<?php echo($fildt['tel']); ?>";
        makeinput();

        label.title = "ایمیل";
        label.classes = "w3-text-green";
        make_label();
        input.name = "email";
        input.id = "email";
        input.type = "text";
        input.classes = "w3-input w3-border datasender";
        input.values = "<?php echo($fildt['email']); ?>";
        makeinput();

        fastbtn("اعمال تغییرات", "snddata()");


        function snddata() {
            postobj.send_type = "post";
            postobj.post_url = "profile_edit.php";
            postobj.after_success = function (data) {
                var resjs = JSON.parse(data);
                alert(resjs.msg);
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