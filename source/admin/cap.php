<?php
session_start();
include("../lib/php/lib_include.php");
$ml = new mobile_input();
$capname = $ml->set_name("capname")
    ->set_title("نام تصویر امنیتی")
    ->set_important(true)
    ->get_str();

$captcha = new captcha();
$capt = $captcha->createRandomImage($capname);
die($capt);
?>