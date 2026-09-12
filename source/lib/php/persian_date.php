<?php

class persian_date
{
    public function gregorian_to_jalali($g_y, $g_m, $g_d)
    {
        // محاسبات برای تبدیل تاریخ میلادی به شمسی
        $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];

        if ($g_y > 1600) {
            $jy = 979;
            $gy = $g_y - 1600;
        } else {
            $jy = 0;
            $gy = $g_y - 621;
        }

        $gy2 = ($g_m > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + (int)(($gy2 + 3) / 4) - (int)(($gy2 + 99) / 100) + (int)(($gy2 + 399) / 400);
        for ($i = 0; $i < $g_m - 1; ++$i) {
            $days += $g_days_in_month[$i];
        }

        $days += $g_d - 1;

        $j_days = $days - 79;

        $j_np = (int)($j_days / 12053);
        $j_days %= 12053;

        $jy += 33 * $j_np + 4 * (int)($j_days / 1461);
        $j_days %= 1461;

        if ($j_days >= 366) {
            $jy += (int)(($j_days - 1) / 365);
            $j_days = ($j_days - 1) % 365;
        }

        for ($i = 0; $i < 11 && $j_days >= $j_days_in_month[$i]; ++$i) {
            $j_days -= $j_days_in_month[$i];
        }

        $jm = $i + 1;
        $jd = $j_days + 1;

        return [$jy, $jm, $jd];
    }

    public function gregorian_to_jalali_formatted($gregorianDate)
    {
        // تبدیل تاریخ میلادی به سال، ماه و روز
        $timestamp = strtotime($gregorianDate);
        $gregorianYear = date('Y', $timestamp);
        $gregorianMonth = date('m', $timestamp);
        $gregorianDay = date('d', $timestamp);

        // تبدیل تاریخ میلادی به شمسی
        list($jalaliYear, $jalaliMonth, $jalaliDay) = gregorian_to_jalali($gregorianYear, $gregorianMonth, $gregorianDay);

        // تعریف نام ماه‌های شمسی
        $jalaliMonths = [
            1 => "فروردین", 2 => "اردیبهشت", 3 => "خرداد", 4 => "تیر",
            5 => "مرداد", 6 => "شهریور", 7 => "مهر", 8 => "آبان",
            9 => "آذر", 10 => "دی", 11 => "بهمن", 12 => "اسفند"
        ];

        // برگرداندن تاریخ به فرمت "20 شهریور 1403"
        return $jalaliDay . " " . $jalaliMonths[$jalaliMonth] . " " . $jalaliYear;
    }


    /**
     * دریافت تاریخ جاری سیستم به شمسی (یک تابع کامل)
     * @return array ['year' => سال شمسی, 'month' => ماه شمسی (1-12), 'day' => روز شمسی]
     */
    public function get_current_jalali_date()
    {
        // 1. گرفتن تاریخ میلادی جاری
        $gy = (int)date('Y');
        $gm = (int)date('m');
        $gd = (int)date('d');

        // 2. محاسبه روز مبنا (روز ژولیوسی اصلاح شده)
        $g_days_in_month = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = 355666 + (365 * $gy) + floor(($gy2 + 3) / 4) - floor(($gy2 + 99) / 100)
            + floor(($gy2 + 399) / 400) + $gd + $g_days_in_month[$gm - 1];

        // 3. تبدیل به شمسی
        $jy = -1595;
        $leap = false;
        while ($days > 0) {
            $jy++;
            $leap = (($jy % 33 == 1 || $jy % 33 == 5 || $jy % 33 == 9 || $jy % 33 == 13 ||
                    $jy % 33 == 17 || $jy % 33 == 22 || $jy % 33 == 26 || $jy % 33 == 30) &&
                ($jy % 4 != 0));
            $days -= ($leap ? 366 : 365);
        }
        $days += ($leap ? 366 : 365);

        $jm = 1;
        while ($days > 0) {
            if ($jm <= 6) $month_days = 31;
            elseif ($jm <= 11) $month_days = 30;
            else $month_days = $leap ? 30 : 29;

            if ($days <= $month_days) break;
            $days -= $month_days;
            $jm++;
        }
        $jd = $days;

        return ['year' => $jy, 'month' => $jm, 'day' => $jd];
    }


    public function jalali_to_gregorian($year, $month, $day)
    {
        // تشخیص کبیسه شمسی (الگوی 33 ساله)
        $is_leap = function ($y) {
            $rem = $y % 33;
            return in_array($rem, [1, 5, 9, 13, 17, 22, 26, 30]);
        };

        // تعداد روزهای ماه‌های شمسی (با در نظر گرفتن کبیسه)
        $month_days = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, $is_leap($year) ? 30 : 29];

        // محاسبه تعداد روزهای سپری شده از ابتدای سال شمسی (روز مبدأ = 0 برای 1 فروردین)
        $passed_days = $day - 1;
        for ($i = 0; $i < $month - 1; $i++) {
            $passed_days += $month_days[$i];
        }

        // محاسبه تعداد روزهای سال‌های قبل از سال جاری
        $prev_years_days = 0;
        for ($y = 1; $y < $year; $y++) {
            $prev_years_days += $is_leap($y) ? 366 : 365;
        }

        // جمع کل روزهای سپری شده از مبدأ (1 فروردین 1 = 22 مارس 622 میلادی)
        $total_days = $prev_years_days + $passed_days;

        // روز ژولیوسی مبدأ (۱ فروردین ۱) برابر با ۱۹۴۸۳۲۰ (تایید شده با gregoriantojd)
        $epoch_jd = 1948320;

        // روز ژولیوسی هدف
        $target_jd = $epoch_jd + $total_days;

        // تبدیل روز ژولیوسی به تاریخ میلادی (الگوریتم استاندارد)
        $a = $target_jd + 32044;
        $b = (int)((4 * $a + 3) / 146097);
        $c = $a - (int)(($b * 146097) / 4);
        $d = (int)((4 * $c + 3) / 1461);
        $e = $c - (int)((1461 * $d) / 4);
        $m_calc = (int)((5 * $e + 2) / 153);

        $greg_day = $e - (int)((153 * $m_calc + 2) / 5) + 1;
        $greg_month = $m_calc + 3 - 12 * (int)($m_calc / 10);
        $greg_year = $b * 100 + $d - 4800 + (int)($m_calc / 10);

        return sprintf("%04d-%02d-%02d", $greg_year, $greg_month, $greg_day);
    }

}

// مثال استفاده:
/*$gregorianDate = "2024-09-10";
$pd = new persian_date();

echo $pd->gregorian_to_jalali_formatted($gregorianDate);*/
