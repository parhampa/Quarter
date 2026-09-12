<?php
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
$ml = new mobile_input();
$name = $ml->set_name("name")
    ->set_title("نام")
    ->set_important(true)
    ->post_str();
$family = $ml->set_name("family")
    ->set_title("نام خانوادگی")
    ->set_important(true)
    ->post_str();
$mob = $ml->set_name("mob")
    ->set_title("شماره تلفن همراه")
    ->set_important(true)
    ->post_str();
$email = $ml->set_name("email")
    ->set_title("ایمیل")
    ->set_important(false)
    ->post_str();

$mid = $_SESSION['username'];
$sql = "update `admin_user` set `name`='$name',`family`='$family',`tel`='$mob',`email`='$email' where `username`='$mid'";
$db = new database();
$db->connect()->query($sql);
if ($db->res) {
    $ml->json_msg("عملیات با موفقیت انجام شد.", "1");
} else {
    $ml->json_msg("اشکال در ثبت اطلاعات", "0");
}
?>