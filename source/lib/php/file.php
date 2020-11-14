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
        $cfile=basename($_SERVER['SCRIPT_NAME']);
        return $cfile;
    }
}

/*$fl = new filemg();
echo($fl->getfilename());*/
?>