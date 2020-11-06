<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/25/2020
 * Time: 4:01 PM
 */
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
<body class="w3-light-grey" style="direction: rtl;">
<div style="width: 40%; margin-right: 30%; margin-top: 150px; background-color: white; padding: 70px;">
    <h1>ورود به پنل مدیریت</h1>
    <?php
    $lg = new loginpg();
    $lg->showlogin("admin_user", "username", "pass", "main.php");
    ?>
</div>
</body>
</html>
