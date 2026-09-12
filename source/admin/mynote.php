<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/25/2020
 * Time: 4:01 PM
 */
session_start();
include("../lib/php/lib_include.php");
include("check_admin_session.php");
?>
<!DOCTYPE html>
<html>
<title>یادداشت های من</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link href="../fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet">
<script src="../lib/js/jquery.js"></script>
<script src="js/fnuser.js"></script>
<script src="js/modal.js"></script>
<link href="bootstrap-5.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/new.css">
<?php
include("calhead.php");
?>
<body style="direction: rtl;">

<?php include("top.php"); ?>
<?php include("nav.php"); ?>
    <div class="w3-white w3-padding-large w3-margin w3-round-medium w3-right" style="width: 100%;">
        <?php
        $fm = new makeform();
        $fm->set_tbl_key("mynote", "id", 1, "یادداشت های من");
        $fm->CSRF_token();
        $fm->fast_string_input("عنوان", "title", "title", 1, 1, 1);
        $fm->fast_textarea("توضیحات", "txt", "txt");
        $fm->dateinput("tarikh", "تاریخ یاد آوری", 1, 1, 1);
        $fm->fast_number_input("ترتیب نمایش", "ordnum", "ordnum");
        $fm->label("وضعیت انجام", "w3-text-green")
            ->select()
            ->selectname("vaz")
            ->selectid("vaz")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("0", "انجام نشده")
            ->selectaddval("1", "انجام شده")
            ->end()
            ->sndform("vaz", 2, 1, "وضعیت انجام", 1, 1);
        $fm->label("نمایش در صفحه اول", "w3-text-green")
            ->select()
            ->selectname("fpage")
            ->selectid("fpage")
            ->selectclasses("w3-select w3-border")
            ->selectaddval("1", "نمایش در صفحه اول")
            ->selectaddval("0", "نمایش در قسمت مدیریت")
            ->end()
            ->sndform("fpage", 2, 1, "نمایش در صفحه اول", 1, 1);

        $fm->submit();
        $fm->addform();
        $fm->show();
        ?>

    </div>
    <!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>