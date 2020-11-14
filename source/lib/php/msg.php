<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/4/2020
 * Time: 2:08 AM
 */
class message
{
    public function msg($pm, $plc)
    {
        ?>
        <script>
            alert("<?php echo($pm); ?>");
            location.replace("<?php echo($plc); ?>");
        </script>
        <?php
    }

    public function msgb($pm)
    {
        ?>
        <script>
            alert("<?php echo($pm); ?>");
            window.history.back();
        </script>
        <?php
    }
}

?>