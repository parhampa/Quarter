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
$ty = $ml->set_name("ty")
    ->set_title("ty")
    ->set_important(true)
    ->get_int();
$sql = "select * from `mynote` where `id`=$id";
$db = new database();
$db->connect()->query($sql);
if (mysqli_num_rows($db->res) > 0) {
    $fild = mysqli_fetch_assoc($db->res);
    $tarikh = $fild['tarikh'];
    if ($ty == 1) {
        $sql2 = "select * from `mynote` where `tarikh`='$tarikh' order by `ordnum` desc limit 0,1";
    } else {
        $sql2 = "select * from `mynote` where `tarikh`='$tarikh' order by `ordnum` asc limit 0,1";
    }
    $db2 = new database();
    $db2->connect()->query($sql2);
    $fild2 = mysqli_fetch_assoc($db2->res);
    $ordnum = $fild2['ordnum'];
    $nord = 0;
    if ($ty == 1) {
        $nord = $ordnum + 1;
    } else {
        $nord = $ordnum - 1;
    }
    $sql3 = "update `mynote` set `ordnum`=$nord where `id`=$id";
    $db3 = new database();
    $db3->connect()->query($sql3);
    if ($db3->res) {
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
} else {
    ?>
    <script>
        alert("اشکال در انجام عملیات");
        location.replace("index.php");
    </script>
    <?php
}


?>