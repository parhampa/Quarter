<?php
session_start();
header('Access-Control-Allow-Origin: *');
header("Pragma-directive: no-cache");
header("Cache-directive: no-cache");
header("Cache-control: no-cache");
header("Pragma: no-cache");
header("Expires: 0");
include("../lib/php/lib_include.php");
include("check_admin_session.php");
$ml = new mobile_input();
$id = $ml->set_name("id")
    ->set_title("id")
    ->set_important(true)
    ->get_int();

$sql = "update `mynote` set `vaz`=1 where `id`=$id";
$db = new database();
$db->connect()->query($sql);
if ($db->res) {
    ?>
    <script>
        alert("عملیات با موفقیت انجام شد.");
        location.replace("index.php");
    </script>
    <?php
} else {
    ?>
    <script>
        alert("اشکال در انجام عملیات");
        location.replace("index.php");
    </script>
    <?php
}


?>