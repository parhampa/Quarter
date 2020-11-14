<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/30/2020
 * Time: 1:34 AM
 */
class findin
{
    public function rows($tbl, $gfild, $val, $inpid)
    {
        $fm = new makeform();
        $tbl = $fm->sqlstr($tbl);
        $gfild = $fm->sqlstr($gfild);
        $val = $fm->sqlstr($val);
        $db = new database();
        $sql = "select `$gfild` from `$tbl` where `$gfild` like '$val%' limit 0,5";
        $db->connect()->query($sql);
        ?>
        <table class="w3-table w3-striped"
               style="text-align: center; border: solid 1px; padding-right: 30px; padding-left: 30px; width: 100px; text-align: right;"><?php
        while ($fild = mysqli_fetch_assoc($db->res)) {
            ?>
            <tr>
            <td>
                <span onclick="document.getElementById('<?php echo($inpid); ?>').value=this.innerText;"><?php echo($fild[$gfild]); ?></span>
            </td></tr><?php
        }
        ?></table><?php
    }
}

?>