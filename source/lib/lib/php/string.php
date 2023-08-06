<?php

class stringjob
{
    private $start = "";
    private $end = "";
    private $string = "";
    public $count = [];
    public $keys = [];

    public function IsInStr($main_str, $find_str)
    {
        $isther = strpos($main_str, $find_str);
        if (is_numeric($isther) == false || $isther == -1) {
            return false;
        } else {
            return true;
        }
    }

    public function afterSTR()
    {
        $startplc = strpos($this->string, $this->start);
        if ($startplc >= 0) {
            $startplc = $startplc + strlen($this->start);
        }
        $startw = substr($this->string, $startplc);
        return $startw;
    }

    public function beforeSTR()
    {
        $startplc = strpos($this->string, $this->start);
        if ($startplc >= 0) {
            $startplc = $startplc + strlen($this->start);
        }
        $endw = substr($this->string, 0, strpos($this->string, $this->end));
        return $endw;
    }

    public function betweenSTR()
    {
        $startplc = strpos($this->string, $this->start);
        if ($startplc >= 0) {
            $startplc = $startplc + strlen($this->start);
        }
        $startw = substr($this->string, $startplc);
        $endw = substr($startw, 0, strpos($startw, $this->end));
        return $endw;
    }

    public function setString($word)
    {
        $this->string = $word;
        return $this;
    }

    public function setStart($word)
    {
        $this->start = $word;
        return $this;
    }

    public function setEnd($word)
    {
        $this->end = $word;
        return $this;
    }


    public function dokeys($keywords)
    {
        $slist[0] = "و";
        $slist[1] = "در";
        $slist[2] = "به";
        $slist[3] = "از";
        $slist[4] = "که";
        $slist[5] = "می";
        $slist[6] = "این";
        $slist[7] = "است";
        $slist[8] = "را";
        $slist[9] = "با";
        $slist[10] = "های";
        $slist[11] = "برای";
        $slist[12] = "آن";
        $slist[13] = "یک";
        $slist[14] = "شود";
        $slist[15] = "شده";
        $slist[16] = "خود";
        $slist[17] = "ها";
        $slist[18] = "کرد";
        $slist[19] = "شد";
        $slist[20] = "ای";
        $slist[21] = "تا";
        $slist[22] = "کند";
        $slist[23] = "بر";
        $slist[24] = "بود";
        $slist[25] = "گفت";
        $slist[26] = "نیز";
        $slist[27] = "وی";
        $slist[28] = "هم";
        $slist[29] = "کنند";
        $slist[30] = "دارد";
        $slist[31] = "ما";
        $slist[32] = "کرده";
        $slist[33] = "یا";
        $slist[34] = "اما";
        $slist[35] = "باید";
        $slist[36] = "دو";
        $slist[37] = "اند";
        $slist[38] = "هر";
        $slist[39] = "خواهد";
        $slist[40] = "او";
        $slist[41] = "مورد";
        $slist[42] = "آنها";
        $slist[43] = "باشد";
        $slist[44] = "دیگر";
        $slist[45] = "مردم";
        $slist[46] = "نمی";
        $slist[47] = "بین";
        $slist[48] = "پیش";
        $slist[49] = "پس";
        $slist[50] = "اگر";
        $slist[51] = "همه";
        $slist[52] = "صورت";
        $slist[53] = "یکی";
        $slist[54] = "هستند";
        $slist[55] = "بی";
        $slist[56] = "من";
        $slist[57] = "دهد";
        $slist[58] = "هزار";
        $slist[59] = "نیست";
        $slist[60] = "استفاده";
        $slist[61] = "داد";
        $slist[62] = "داشته";
        $slist[63] = "راه";
        $slist[64] = "داشت";
        $slist[65] = "چه";
        $slist[66] = "همچنین";
        $slist[67] = "کردند";
        $slist[68] = "داده";
        $slist[69] = "بوده";
        $slist[70] = "دارند";
        $slist[71] = "همین";
        $slist[72] = "میلیون";
        $slist[73] = "سوی";
        $slist[74] = "شوند";
        $slist[75] = "بیشتر";
        $slist[76] = "بسیار";
        $slist[77] = "روی";
        $slist[78] = "گرفته";
        $slist[79] = "هایی";
        $slist[80] = "تواند";
        $slist[81] = "اول";
        $slist[82] = "نام";
        $slist[83] = "هیچ";
        $slist[84] = "چند";
        $slist[85] = "جدید";
        $slist[86] = "بیش";
        $slist[87] = "شدن";
        $slist[88] = "کردن";
        $slist[89] = "کنیم";
        $slist[90] = "نشان";
        $slist[91] = "حتی";
        $slist[92] = "اینکه";
        $slist[93] = "ولی";
        $slist[94] = "توسط";
        $slist[95] = "چنین";
        $slist[96] = "برخی";
        $slist[97] = "نه";
        $slist[98] = "دیروز";
        $slist[99] = "دوم";
        $slist[100] = "درباره";
        $slist[101] = "بعد";
        $slist[102] = "مختلف";
        $slist[103] = "گیرد";
        $slist[104] = "شما";
        $slist[105] = "گفته";
        $slist[106] = "آنان";
        $slist[107] = "بار";
        $slist[108] = "طور";
        $slist[109] = "گرفت";
        $slist[110] = "دهند";
        $slist[111] = "گذاری";
        $slist[112] = "بسیاری";
        $slist[113] = "طی";
        $slist[114] = "بودند";
        $slist[115] = "میلیارد";
        $slist[116] = "بدون";
        $slist[117] = "تمام";
        $slist[118] = "کل";
        $slist[119] = "تر";
        $slist[120] = "شدند";
        $slist[121] = "ترین";
        $slist[122] = "امروز";
        $slist[123] = "باشند";
        $slist[124] = "ندارد";
        $slist[125] = "چون";
        $slist[126] = "قابل";
        $slist[127] = "گوید";
        $slist[128] = "دیگری";
        $slist[129] = "همان";
        $slist[130] = "خواهند";
        $slist[131] = "قبل";
        $slist[132] = "آمده";
        $slist[133] = "اکنون";
        $slist[134] = "تحت";
        $slist[135] = "طریق";
        $slist[136] = "گیری";
        $slist[137] = "جای";
        $slist[138] = "هنوز";
        $slist[139] = "چرا";
        $slist[140] = "البته";
        $slist[141] = "کنید";
        $slist[142] = "سازی";
        $slist[143] = "سوم";
        $slist[144] = "کنم";
        $slist[145] = "بلکه";
        $slist[146] = "زیر";
        $slist[147] = "توانند";
        $slist[148] = "ضمن";
        $slist[149] = "فقط";
        $slist[150] = "بودن";
        $slist[151] = "حق";
        $slist[152] = "آید";
        $slist[153] = "وقتی";
        $slist[154] = "اش";
        $slist[155] = "یابد";
        $slist[156] = "نخستین";
        $slist[157] = "مقابل";
        $slist[158] = "خدمات";
        $slist[159] = "امسال";
        $slist[160] = "تاکنون";
        $slist[161] = "مانند";
        $slist[162] = "تازه";
        $slist[163] = "آورد";
        $slist[164] = "فکر";
        $slist[165] = "آنچه";
        $slist[166] = "نخست";
        $slist[167] = "نشده";
        $slist[168] = "شاید";
        $slist[169] = "چهار";
        $slist[170] = "جریان";
        $slist[171] = "پنج";
        $slist[172] = "ساخته";
        $slist[173] = "زیرا";
        $slist[174] = "نزدیک";
        $slist[175] = "برداری";
        $slist[176] = "کسی";
        $slist[177] = "ریزی";
        $slist[178] = "رفت";
        $slist[179] = "گردد";
        $slist[180] = "مثل";
        $slist[181] = "آمد";
        $slist[182] = "ام";
        $slist[183] = "بهترین";
        $slist[184] = "دانست";
        $slist[185] = "کمتر";
        $slist[186] = "دادن";
        $slist[187] = "تمامی";
        $slist[188] = "جلوگیری";
        $slist[189] = "بیشتری";
        $slist[190] = "ایم";
        $slist[191] = "ناشی";
        $slist[192] = "چیزی";
        $slist[193] = "آنکه";
        $slist[194] = "بالا";
        $slist[195] = "بنابراین";
        $slist[196] = "ایشان";
        $slist[197] = "بعضی";
        $slist[198] = "دادند";
        $slist[199] = "داشتند";
        $slist[200] = "برخوردار";
        $slist[201] = "نخواهد";
        $slist[202] = "هنگام";
        $slist[203] = "نباید";
        $slist[204] = "غیر";
        $slist[205] = "نبود";
        $slist[206] = "دیده";
        $slist[207] = "وگو";
        $slist[208] = "داریم";
        $slist[209] = "چگونه";
        $slist[210] = "بندی";
        $slist[211] = "خواست";
        $slist[212] = "فوق";
        $slist[213] = "ده";
        $slist[214] = "نوعی";
        $slist[215] = "هستیم";
        $slist[216] = "دیگران";
        $slist[217] = "همچنان";
        $slist[218] = "سراسر";
        $slist[219] = "ندارند";
        $slist[220] = "گروهی";
        $slist[221] = "سعی";
        $slist[222] = "روزهای";
        $slist[223] = "آنجا";
        $slist[224] = "یکدیگر";
        $slist[225] = "کردم";
        $slist[226] = "بیست";
        $slist[227] = "بروز";
        $slist[228] = "سپس";
        $slist[229] = "رفته";
        $slist[230] = "آورده";
        $slist[231] = "نماید";
        $slist[232] = "باشیم";
        $slist[233] = "گویند";
        $slist[234] = "زیاد";
        $slist[235] = "خویش";
        $slist[236] = "همواره";
        $slist[237] = "گذاشته";
        $slist[238] = "شش";
        $slist[239] = "شناسی";
        $slist[240] = "خواهیم";
        $slist[241] = "آباد";
        $slist[242] = "داشتن";
        $slist[243] = "نظیر";
        $slist[244] = "همچون";
        $slist[245] = "باره";
        $slist[246] = "نکرده";
        $slist[247] = "شان";
        $slist[248] = "سابق";
        $slist[249] = "هفت";
        $slist[250] = "دانند";
        $slist[251] = "جایی";
        $slist[252] = "بی";
        $slist[253] = "جز";
        $slist[254] = "زیر";
        $slist[255] = "روی";
        $slist[256] = "سری";
        $slist[257] = "توی";
        $slist[258] = "جلوی";
        $slist[259] = "پیش";
        $slist[260] = "عقب";
        $slist[261] = "بالای";
        $slist[262] = "خارج";
        $slist[263] = "وسط";
        $slist[264] = "بیرون";
        $slist[265] = "سوی";
        $slist[266] = "کنار";
        $slist[267] = "پاعین";
        $slist[268] = "نزد";
        $slist[269] = "نزدیک";
        $slist[270] = "دنبال";
        $slist[271] = "حدود";
        $slist[272] = "برابر";
        $slist[273] = "طبق";
        $slist[274] = "مانند";
        $slist[275] = "ضد";
        $slist[276] = "هنگام";
        $slist[277] = "برای";
        $slist[278] = "مثل";
        $slist[279] = "بارة";
        $slist[280] = "اثر";
        $slist[281] = "تول";
        $slist[282] = "علت";
        $slist[283] = "سمت";
        $slist[284] = "عنوان";
        $slist[285] = "قصد";
        $slist[286] = "روب";
        $slist[287] = "جدا";
        $slist[288] = "کی";
        $slist[289] = "که";
        $slist[290] = "چیست";
        $slist[291] = "هست";
        $slist[292] = "کجا";
        $slist[293] = "کجاست";
        $slist[294] = "کی";
        $slist[295] = "چطور";
        $slist[296] = "کدام";
        $slist[297] = "آیا";
        $slist[298] = "مگر";
        $slist[299] = "چندین";
        $slist[300] = "یک";
        $slist[301] = "چیزی";
        $slist[302] = "دیگر";
        $slist[303] = "کسی";
        $slist[304] = "بعری";
        $slist[305] = "هیچ";
        $slist[306] = "چیز";
        $slist[307] = "جا";
        $slist[308] = "کس";
        $slist[309] = "هرگز";
        $slist[310] = "یا";
        $slist[311] = "تنها";
        $slist[312] = "بلکه";
        $slist[313] = "خیاه";
        $slist[314] = "بله";
        $slist[315] = "بلی";
        $slist[316] = "آره";
        $slist[317] = "آری";
        $slist[318] = "مرسی";
        $slist[319] = "البته";
        $slist[320] = "لطفا";
        $slist[321] = "انکه";
        $slist[322] = "وقتیکه";
        $slist[323] = "همین";
        $slist[324] = "پیش";
        $slist[325] = "مدتی";
        $slist[326] = "هنگامی";
        $slist[327] = "مان";
        $slist[328] = "تان";
        $slist[329] = "براساس";
        $slist[330] = "نداشته";

        $tmpkey = $keywords;
        $tmpkey = str_replace("    ", " , ", $tmpkey);
        $tmpkey = str_replace("   ", " , ", $tmpkey);
        $tmpkey = str_replace("   ", " , ", $tmpkey);
        $tmpkey = str_replace("  ", " , ", $tmpkey);
        $tmpkey = str_replace(" ", " , ", $tmpkey);
        $tmpkey = str_replace("|", " , ", $tmpkey);
        $tmpkey = str_replace(".", " , ", $tmpkey);
        $tmpkey = str_replace("،", " , ", $tmpkey);
        $tmpkey = str_replace("/", " , ", $tmpkey);
        $tmpkey = str_replace("\\", " , ", $tmpkey);
        $tmpkey = str_replace("ك", "ک", $tmpkey);
        $tmpkey = str_replace("ي", "ی", $tmpkey);
        for ($k = 0; $k < 10; $k++) {
            $tmpkey = str_replace(",,", ",", $tmpkey);
        }
        /*for ($i = 0; $i < sizeof($slist); $i++) {
            $tmpkey = str_replace($slist[$i], "", $tmpkey);
        }*/
        $keys[0] = "";
        $ckeys[0] = "";
        $number[0] = "";
        $i = 0;
        $c = 0;
        $n = 0;
        while (strpos($tmpkey, ',') != -1 && strpos($tmpkey, ',') != 0) {
            $tmpword = trim(substr($tmpkey, 0, strpos($tmpkey, ',')));
            $isthere = false;
            $ckeys[$c] = trim($tmpword);
            $c++;
            if (in_array($tmpword, $keys)) {
                $isthere = true;
            } else {
                $keys[$i] = $tmpword;
                $i++;
            }
            $tmpkey = substr($tmpkey, strpos($tmpkey, ',') + 1);
        }
        $ckeys[$c] = trim($tmpkey);
        $c++;
        if ($tmpkey != "") {
            if (!in_array(trim($tmpkey), $keys)) {
                $keys[$i] = trim($tmpkey);
                $i++;
            }
        }
        /*var_dump($keys);
        echo(PHP_EOL);
        var_dump($ckeys);*/
        for ($j = 0; $j < $i; $j++) {
            $count = 0;
            for ($z = 0; $z < $c; $z++) {
                //echo($keys[$j].":".$ckeys[$z].PHP_EOL);
                if ($keys[$j] == $ckeys[$z]) {
                    $count++;
                }
            }
            $number[$j] = $count;
            //echo("number : ".$number[$j].PHP_EOL);
            //echo($keys[$j]." : ".$count.PHP_EOL);
        }
        $jstring = "";
        for ($im = 0; $im < $i; $im++) {
            if ($jstring == "") {
                $jstring = $keys[$im];
            } else {
                $jstring .= " ," . $keys[$im];
            }
        }
        $res = "";
        for ($j = 0; $j < $i; $j++) {
            if (trim($keys[$j]) != "" && trim($keys[$j]) != '') {
                if (is_numeric($keys[$j]) == false && strlen($keys[$j]) > 2) {
                    if (!in_array($keys[$j], $slist)) {
                        //$res = $res . "('" . $keys[$j] . "'," . $number[$j] . ")" . PHP_EOL;
                        if ($res == "") {
                            $res = $res . '{"key":"' . $keys[$j] . '","count":"' . $number[$j] . '"}';
                        } else {
                            $res = $res . ',{"key":"' . $keys[$j] . '","count":"' . $number[$j] . '"}';
                        }
                        $this->keys[sizeof($this->keys)] = $keys[$j];
                        $this->count[sizeof(($this->count))] = $number[$j];
                        //$myfile = file_put_contents('keywords.tmp', $res, FILE_APPEND | LOCK_EX);
                    }
                }
            }
        }
        $res = '{"keys":[' . $res . ']}';
        return $res;
    }

    public function strcheck($str)
    {
        if (is_array($str) == true) {
            die("input is an array...");
        }
        $out = str_replace("'", "&#" . ord("'") . ";", $str);
        $out = str_replace("*", "&#" . ord("*") . ";", $out);
        $out = str_replace(",", "&#" . ord(",") . ";", $out);
        $out = str_replace('"', "&#" . ord('"') . ";", $out);
        $out = str_replace("&", "&#" . ord("&") . ";", $out);
        $out = str_replace("%", "&#" . ord("%") . ";", $out);
        $out = str_replace("(", "&#" . ord("(") . ";", $out);
        $out = str_replace(")", "&#" . ord(")") . ";", $out);
        //$out = str_replace("_", "&#" . ord("_") . ";", $out);
        $out = str_replace('\\', "&#" . ord("\\") . ";", $out);
        $out = str_replace('|', "&#" . ord("|") . ";", $out);
        $out = str_replace('<', "&#" . ord("<") . ";", $out);
        $out = str_replace('>', "&#" . ord(">") . ";", $out);
        if ($out != $str) {
            return 0;
        } else {
            return 1;
        }
    }

    public function rem_html($str)
    {
        $nstr = $str;
        $nstr = $this->clean_jscode($nstr);
        $nstr = $this->setStart("<body")
            ->setEnd("</body")
            ->setString($str)
            ->betweenSTR();
        $nstr = preg_replace("/<a[^>]+\>[a-z]+/i", "", $nstr);
        $nstr = strip_tags($nstr);
        /*$nstr = str_replace(">", " ", $nstr);
        $nstr = str_replace("<", " ", $nstr);*/
        $nstr = str_replace("\n", " ", $nstr);
        $nstr = str_replace("\r", " ", $nstr);

        return $nstr;
    }

    public function URLcleaner($url)
    {
        $U = explode(' ', $url);

        $W = array();
        foreach ($U as $k => $u) {
            if (stristr($u, 'http') || (count(explode('.', $u)) > 1)) {
                unset($U[$k]);
                return cleaner(implode(' ', $U));
            }
        }
        return implode(' ', $U);
    }

    public function clean_jscode($script_str)
    {
        $script_str = htmlspecialchars_decode($script_str);
        $search_arr = array('<script', '</script>');
        $script_str = str_ireplace($search_arr, $search_arr, $script_str);
        $split_arr = explode('<script', $script_str);
        $remove_jscode_arr = array();
        foreach ($split_arr as $key => $val) {
            $newarr = explode('</script>', $split_arr[$key]);
            $remove_jscode_arr[] = ($key == 0) ? $newarr[0] : $newarr[1];
        }
        return implode('', $remove_jscode_arr);
    }

    public function clean_space($str)
    {
        $res = str_replace(" ", "-", $str);
        $res = str_replace("|", "-", $res);
        $res = str_replace("&#124;", "-", $res);
        return $res;
    }

    public function MakeUnicode($txt)
    {
        return mb_convert_encoding($txt, 'UTF-16LE', 'UTF-8');
    }
}

/*
$sj = new stringjob();
$res = $sj->setStart("hhh")
    ->setString("hhhjamshidseee")
    ->setEnd("eee")
    ->beforeSTR();
echo($res);*/
?>