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
        $res .= '<div class="w3-modal-content w3-border" style="margin-top: 50px;">';
        $res .= '<div class="w3-container" style="padding: 10%;">';
        $res .= '<span onclick="document.getElementById(' . "'" . $id . "'" . ').style.display=' . "'" . 'none' . "'" . '" class="w3-button w3-display-topright w3-gray">&times;</span>';
        $res .= $inside;
        $res .= "</div></div></div>";
        echo($res);
    }

    function add_inner_modal_top($id)
    {
        $res = "<!-- The Modal -->";
        $res .= '<div id="' . $id . '" class="w3-modal">';
        $res .= '<div class="w3-modal-content">';
        $res .= '<div class="w3-container" style="padding: 50px;">';
        $res .= '<span onclick="document.getElementById(' . "'" . $id . "'" . ').style.display=' . "'" . 'none' . "'" . '" class="w3-button w3-display-topright">&times;</span>';
        echo($res);
    }

    function add_inner_modal_down()
    {
        $res = "</div></div></div>";
        echo($res);
    }

    private $title_htm = "";
    private $txt_htm = "";
    private $btn_htm = "";

    public function set_title($title, $style = '', $class = '')
    {
        $this->title_htm = "<h2 style='$style' class='$class'>$title</h2>";
        return $this;
    }

    public function set_txt($txt, $style = '', $class = '')
    {
        $this->txt_htm = "<p style='$style' class='$class'>$txt</p>";
        return $this;
    }

    public function set_btn_htm($title = '', $style = '', $class = '', $onclick = '')
    {
        $this->btn_htm .= "<input type='button' class='$class' style='$style' value='$title' onclick='$onclick'>";
        return $this;
    }

    public function clean_btn_htm()
    {
        $this->btn_htm = "";
        return $this;
    }

    public function fast_modal($id)
    {
        $inside = $this->title_htm . $this->txt_htm . $this->btn_htm;
        $this->make_modal($id, $inside);
        return $this;
    }


}

?>