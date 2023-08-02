<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/25/2020
 * Time: 4:01 PM
 */
session_start();
include("../lib/php/lib_include.php");
?>
<!DOCTYPE html>
<html>
<title>ورود به پنل مدیریت</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<script src="../lib/js/jquery.js"></script>
<script src="js/fnuser.js"></script>
<script src="js/modal.js"></script>
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: Tahoma;
    }

    body {
        font-size: 12px;
    }
</style>
<body class="w3-light-grey" style="direction: rtl;" onload="scch()">
<div style="width: 60%; margin-right: 20%; margin-top: 10px; background-color: white; padding: 70px;" class="w3-card-2"
     id="fdive">
    <br>
    <br>
    <br>
    <div style="width: 60%;margin-right: 20%;" id="sdive">
        <h3>ورود به پنل مدیریت</h3>
        <?php
        $lg = new loginpg();
        $lg->showlogin("admin_user", "username", "pass", "index.php");
        ?>
    </div>

    <br>
    <h5>
        طراحی و پیاده سازی
        <span class="w3-text-green">
            تیم نرم افزاری X4Y
	</span>
    </h5>
</div>
<script>
    function scch() {
        if (window.screen.availWidth <= 600) {
            document.getElementById('fdive').style.width = "90%";
            document.getElementById('fdive').style.marginRight = "5%";
            document.getElementById('sdive').style.width = "100%";
            document.getElementById('sdive').style.marginRight = "0px";
        }
    }
</script>
</body>
</html>
