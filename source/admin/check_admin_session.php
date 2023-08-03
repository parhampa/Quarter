<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 10/14/2020
 * Time: 4:37 AM
 */
$adminses = new ses();
$adminses->check_session("admin_user", "username", "active", "login.php", "شما به این قسمت دسترسی ندارید");
?>