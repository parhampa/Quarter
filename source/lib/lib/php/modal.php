<?php
/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 8/2/2020
 * Time: 3:51 AM
 */
class modal
{
    function make_modal($id, $inside)
    {
        $res = "<!-- The Modal -->";
        $res .= '<div id="' . $id . '" class="w3-modal">';
        $res .= '<div class="w3-modal-content">';
        $res .= '<div class="w3-container" style="padding: 50px;">';
        $res .= '<span onclick="document.getElementById(' . "'" . $id . "'" . ').style.display=' . "'" . 'none' . "'" . '" class="w3-button w3-display-topright">&times;</span>';
        $res .= $inside;
        $res .= "</div></div></div>";
        echo($res);
    }
}

?>