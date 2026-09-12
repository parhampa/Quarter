<?php
session_start();
echo("خداحافظ");
session_destroy();
?>
<script>
    location.replace("login.php");
</script>
