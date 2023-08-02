<?php

/**
 * Created by PhpStorm.
 * User: ormazd
 * Date: 7/4/2020
 * Time: 1:55 AM
 */
class filemg
{
    public function base64_to_jpeg($base64_string, $output_file)
    {
        // open the output file for writing
        $ifp = fopen($output_file, 'wb');

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64_string);

        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));

        // clean up the file resource
        fclose($ifp);

        return $output_file;
    }

    public function png2jpg($originalFile, $outputFile, $quality)
    {
        $image = imagecreatefrompng($originalFile);
        imagejpeg($image, $outputFile, $quality);
        imagedestroy($image);
    }

    public function compressjpg($oldpic, $up = 0)
    {
        // 50 is quality; change from 0 (worst quality,smaller file) - 100 (best quality)
        if ($up == 0) {
            $newpic = md5($oldpic) . ".jpg";
            if (str_replace(".png", "", $oldpic) == $oldpic) {
                $img = imagecreatefromjpeg($oldpic);   // load the image-to-be-saved
                imagejpeg($img, $newpic, 50);
            } else {
                $this->png2jpg($oldpic, $newpic, 50);
            }
            $fl = new filemg();
            $fl->del_file($oldpic);// remove the old image


            return $newpic;
        } else {
            $newpic = $oldpic;

            if (str_replace(".png", "", $oldpic) == $oldpic) {
                $img = imagecreatefromjpeg($oldpic);   // load the image-to-be-saved
                //$this->imagejpeg($img, $newpic, 50);
            } else {
                $this->png2jpg($oldpic, $newpic, 50);
            }

            //$fl = new filemg();
            //$fl->del_file($oldpic);// remove the old image
            return $newpic;
        }
    }

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

    public function readallfile($file)
    {
        $myfile = fopen($file, "r") or die("Unable to open file!");
        $out = fread($myfile, filesize($file));
        fclose($myfile);
        return $out;
    }

}

function getpic($pic)
{
    if ($pic != "") {
        $pic = str_replace("../", $GLOBALS["web_url"], $pic);
        //$pic = str_replace("../", "", $pic);
        echo($pic);
    } else {
        echo($GLOBALS["web_url"] . "nopic.jpg");
    }
}


/*$fl = new filemg();
echo($fl->getfilename());*/
?>