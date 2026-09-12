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
<title>داشبورد مدیریت</title>
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
    <div class="w3-margin w3-round-medium">
        <div class="w3-mobile" style="width: 100%;">
            <div class="w3-card w3-panel w3-white w3-padding">
                تعداد کاربران امروز:
                <?php
                $uc = new user_control();
                echo($uc->get_today_ip_count());
                ?>
                نفر
                <br>
                تعداد کاربران دیروز:
                <?php
                echo($uc->get_yesterday_ip_count());
                ?>
                نفر
                <br>
                تعداد کاربران 2 روز پیش:
                <?php
                echo($uc->get_your_date_ip_count(2));
                ?>
                نفر
                <br>
                تعداد کاربران 3 روز پیش:
                <?php
                echo($uc->get_your_date_ip_count(3));
                ?>
                نفر
                <br>
                تعداد کاربران 4 روز پیش:
                <?php
                echo($uc->get_your_date_ip_count(4));
                ?>
                نفر
                <br>
                تعداد کاربران 5 روز پیش:
                <?php
                echo($uc->get_your_date_ip_count(5));
                ?>
                نفر
                <br>
                تعداد کاربران 6 روز پیش:
                <?php
                echo($uc->get_your_date_ip_count(6));
                ?>
                نفر
            </div>
            <?php
            $sqlt = "select distinct `tarikh` from `mynote` where `fpage`=1 and `vaz`=0 order by tarikh";
            $dbt = new database();
            $dbt->connect()->query($sqlt);
            while ($fildt = mysqli_fetch_assoc($dbt->res)) {
                ?>
                <div class="w3-third w3-padding w3-right">
                    <div style=" width: 100%; text-align: center;">
                        <i class="fa fa-calendar"></i>
                        <span>
                            <?php
                            $year = substr($fildt['tarikh'], 0, 4);
                            $month = substr($fildt['tarikh'], 5, 2);
                            $day = substr($fildt['tarikh'], 8, 2);
                            $jdate = gregorian_to_jalali($year, $month, $day);
                            $jfdate = $jdate[0] . "-" . $jdate[1] . "-" . $jdate[2];
                            echo($jfdate);
                            ?>
                        </span>
                    </div>
                    <div class="w3-white w3-card w3-round"
                         style="min-height:200px; max-height: 200px; overflow-y: scroll;">
                        <ul>
                            <?php
                            $tarikh = $fildt['tarikh'];
                            $sqln = "select * from `mynote` where `tarikh`='$tarikh' and `fpage`=1 and vaz=0 order by `ordnum` desc ";
                            $dbn = new database();
                            $dbn->connect()->query($sqln);
                            while ($fildn = mysqli_fetch_assoc($dbn->res)) {
                                ?>
                                <li>
                                    <a href="#" title="<?php echo($fildn['txt']); ?>"
                                       alt="<?php echo($fildn['txt']); ?>" style="text-decoration: none;">
                                        <span><?php echo($fildn['title']); ?></span>
                                    </a>
                                    <br>
                                    <span class="w3-left w3-margin-left">
                                    <a href="mynote.php?action=editform&id=<?php echo($fildn['id']); ?>"
                                       style="text-decoration: none;" target="_blank">
                                        <i class="fa fa-eye w3-text-blue"></i>
                                    </a>
                                        <a href="change_note_vaz.php?id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-check w3-text-blue"></i>
                                        </a>
                                        <a href="change_note_order.php?ty=0&id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-arrow-down w3-text-red"></i>
                                        </a>
                                        <a href="change_note_order.php?ty=1&id=<?php echo($fildn['id']); ?>"
                                           style="text-decoration: none;">
                                            <i class="fa fa-arrow-up w3-text-green"></i>
                                        </a>
                            </span>
                                </li>
                                <hr>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End page content -->
</div>
<?php
include("footer.php");
?>
</body>
</html>