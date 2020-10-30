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
$database = "";
$db_user = "";
$db_pass = "";
header_remove("X-Powered-By");
header_remove("Server");
?>