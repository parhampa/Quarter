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
        try {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $originalFile);

            if (isset($type) && in_array($type, array("image/png"))) {
                $image = imagecreatefrompng($originalFile);
                imagejpeg($image, $outputFile, $quality);
                imagedestroy($image);
            } else {
                echo '';
            }
        } catch (Exception $e) {
            echo("wrong file");
        }

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
                try {
                    $this->png2jpg($oldpic, $newpic, 50);
                } catch (Exception $e) {
                    echo("wrong file");
                }
            }
            $fl = new filemg();
            $fl->del_file($oldpic);// remove the old image


            return $newpic;
        } else {
            $newpic = $oldpic;

            if (str_replace(".png", "", $oldpic) == $oldpic && str_replace(".webp", "", $oldpic) == $oldpic) {
                try {
                    $img = imagecreatefromjpeg($oldpic);   // load the image-to-be-saved
                } catch (Exception $e) {
                    echo("wrong file");
                }
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

    public function deleteFileIfExists($filePath) {
        if (file_exists($filePath)) {
            unlink($filePath);
            return true; // فایل با موفقیت حذف شد
        }
        return false; // فایل وجود ندارد
    }

    public function addToExcelFile($filePath, $id, $title, $txt) {
        $data = [];

        // بررسی وجود فایل
        if (file_exists($filePath)) {
            // اگر فایل وجود دارد، داده‌ها را بخوان
            $file = fopen($filePath, 'r');
            while (($line = fgetcsv($file)) !== FALSE) {
                $data[] = $line;
            }
            fclose($file);
        }

        // اضافه کردن مقادیر جدید
        if (empty($data)) {
            // اگر فایل خالی است، عنوان‌ها را اضافه کن
            $data[] = ['id', 'title', 'txt'];
        }
        $data[] = [$id, $title, $txt];

        // نوشتن مجدد داده‌ها به فایل
        $file = fopen($filePath, 'w');
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        return true; // عملیات موفقیت‌آمیز
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