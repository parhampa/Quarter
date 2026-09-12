<?php

class captcha
{
    public function createRandomImage($ses_name = "")
    {
        // تولید عدد تصادفی ۴ رقمی
        $randomNumber = rand(10000, 99999);
        if ($ses_name != "") {
            $_SESSION[$ses_name] = $randomNumber;
        }

        // ایجاد تصویر با ابعاد 200 در 100
        $width = 100;
        $height = 50;
        $image = imagecreatetruecolor($width, $height);

        if (!$image) {
            die('Failed to create image');
        }

        // رنگ‌ها
        $backgroundColor = imagecolorallocate($image, 255, 255, 255); // سفید
        $textColor = imagecolorallocate($image, 0, 0, 0); // سیاه
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

        // اندازه متن
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($randomNumber);
        $textHeight = imagefontheight($fontSize);

        // محاسبه موقعیت متن برای مرکز کردن
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        // قرار دادن عدد روی تصویر
        imagestring($image, $fontSize, $x, $y, $randomNumber, $textColor);

        // افزودن نویز تصادفی
        for ($i = 0; $i < 500; $i++) {
            $noiseColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($image, rand(0, $width - 1), rand(0, $height - 1), $noiseColor);
        }

        // بافر کردن خروجی تصویر
        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);

        // کدگذاری تصویر به Base64
        $base64Image = base64_encode($imageData);

        // بازگرداندن رشته Base64 مناسب برای تگ img
        return 'data:image/png;base64,' . $base64Image;
    }
}

// استفاده از کلاس
$captcha = new captcha();
$imageSrc = $captcha->createRandomImage();
?>
