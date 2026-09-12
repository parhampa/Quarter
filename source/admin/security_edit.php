<?php
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
$ml = new mobile_input();

$pass = $ml->set_name("pass")
    ->set_title("کلمه عبور پیشین")
    ->set_important(true)
    ->post_str();

$newpass = $ml->set_name("newpass")
    ->set_title("کلمه عبور جدید")
    ->set_important(true)
    ->post_str();

$newpass2 = $ml->set_name("newpass2")
    ->set_title("تکرار کلمه عبور جدید")
    ->set_important(true)
    ->post_str();

if ($newpass != $newpass2) {
    $ml->json_msg("کلمه عبور جدید و تکرار آن با هم یکسان نیستند.", 0);
    die();
}

$mid = $_SESSION['username'];
$sqlt = "select * from `admin_user` where `username`='$mid' and `pass`='$pass'";
$dbt = new database();
$dbt->connect()->query($sqlt);

if (mysqli_num_rows($dbt->res) == 0) {
    $ml->json_msg("کلمه عبور پیشین اشتباه می باشد.", "0");
    die();
} else {
    $sql = "update `admin_user` set `pass`='$newpass' where `username`='$mid'";
    $db = new database();
    $db->connect()->query($sql);
    if ($db->res) {
        $ml->json_msg("عملیات با موفقیت انجام شد", "1");
        die();
    } else {
        $ml->json_msg("اشکال در انجام عملیات", "0");
        die();
    }
}
?>