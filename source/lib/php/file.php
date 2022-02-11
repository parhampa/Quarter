<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/4/2020
 * Time: 1:55 AM
 */
class filemg
{
    public function getfilename()
    {
        /*$directory = str_replace("/", "\\", $_SERVER['SCRIPT_FILENAME']);
        $cfile = str_replace(getcwd(), "", $directory);
        $cfile = str_replace("\\", "", $cfile);*/
        $cfile = basename($_SERVER['SCRIPT_NAME']);
        return $cfile;
    }

    public function del_file($file)
    {
        if (file_exists($file)) {
            unlink($file);
            return true;
        } else {
            return false;
        }
    }

    public function ADDtoFile($txt, $file)
    {
        $myfile = fopen($file, "w") or die("Unable to open file!");
        fwrite($myfile, $txt);
        fclose($myfile);
        return $this;
    }
}

function getpic($pic)
{
    if ($pic != "") {
        $pic = str_replace("../", $GLOBALS["web_url"], $pic);
        echo($pic);
    } else {
        echo("images/no-image.png");
    }
}


/*$fl = new filemg();
echo($fl->getfilename());*/
?>