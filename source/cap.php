<?php
include("lib_include.php");
if (isset($_GET['cpt']) == true) {
    $captcha = new captcha();
    die($captcha->createRandomImage());
}
?>
<html>
<head>
    <script src="lib/js/jquery.js"></script>
    <script src="lib/js/palib.js"></script>
</head>
<div>
    <img src="" id="res">
</div>
<input type="hidden" name="capt" id="capt" class="sndcpt">
<input type="button" value="تصویر جدید" onclick="loadcpt()">
<script>
    function loadcpt() {
        postobj.send_type = "post";
        postobj.post_url = "cap.php?cpt=1";
        postobj.after_success = function (data) {
            document.getElementById('res').src = data;
        }
        res_obj_postdata("sndcpt");
    }
</script>

</html>