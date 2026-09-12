<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/3/2020
 * Time: 2:16 AM
 */
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tehran');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = "localhost";
$database = "quarter";
$db_user = "root";
$db_pass = "";
$web_url = "http://localhost/quarter";
$web_title = "quarter framework";
$pay_bank = 0;
$pay_wallet = 0;
header_remove("X-Powered-By");
header_remove("Server");
?>