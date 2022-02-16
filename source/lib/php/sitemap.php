<?php

class sitemap
{
    private $fileaddr = "";

    private $res = "";

    private $loc = "";
    private $lastmod = "";
    private $ChangeFreq = "daily";
    private $priority = "0.9";

    public function SetFile($var)
    {
        $this->fileaddr = $var;
        return $this;
    }

    public function SetLoc($var)
    {
        $this->loc = trim($var);
        return $this;
    }

    public function Setlastmod($lastmod)
    {
        $this->lastmod = $lastmod;
        return $this;
    }

    public function SetChangeFreq($var)
    {
        $this->ChangeFreq = $var;
        return $this;
    }

    public function SetPriority($var)
    {
        $this->priority = $var;
        return $this;
    }

    public function AddToSitemap()
    {
        $subres = "<url>" . PHP_EOL;
        $subres .= "<loc>" . $this->loc . "</loc>" . PHP_EOL;
        $subres .= "<lastmod>" . $this->lastmod . "</lastmod>" . PHP_EOL;
        $subres .= "<changefreq>" . $this->ChangeFreq . "</changefreq>" . PHP_EOL;
        $subres .= "<priority>" . $this->priority . "</priority>" . PHP_EOL;
        $subres .= "</url>" . PHP_EOL;
        $this->res .= $subres;
    }

    public function MakeSitemap()
    {
        $this->res = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL . $this->res;
        $this->res .= "</urlset>";
        return $this;
    }

    public function WriteSitemap()
    {
        $fl = new filemg();
        $fl->ADDtoFile($this->res, $this->fileaddr);
        return $this;
    }

    private $paramval = [];
    private $paramname = [];
    private $url = "";

    public function SetParamVal($param, $val)
    {
        $this->paramname[sizeof($this->paramname)] = $param;
        $this->paramval[sizeof($this->paramval)] = $val;
        return $this;
    }

    public function SetURL($var)
    {
        $this->url = $var;
        return $this;
    }

    public $tbl = "";

    public function SetTBL($tbl)
    {
        $this->tbl = $tbl;
        return $this;
    }

    public function AddFromTBL($orderby, $lastmod = "")
    {
        $tbl = $this->tbl;
        $sql = "select * from `$tbl` order by `$orderby` desc limit 0,1000";
        $db = new database();
        $db->connect()->query($sql);
        while ($fild = mysqli_fetch_assoc($db->res)) {
            $newurl = $this->url . "?";
            for ($i = 0; $i < sizeof($this->paramname); $i++) {
                $paramval = $fild[$this->paramval[$i]];
                if (is_numeric($paramval) == false) {
                    $str = new stringjob();
                    $paramval = $str->clean_space($paramval);
                }
                if ($i == 0) {
                    $newurl .= $this->paramname[$i] . "=" . $paramval;
                } else {
                    $newurl .= "&" . $this->paramname[$i] . "=" . $paramval;
                }
            }
            $this->SetLoc($newurl);
            if ($lastmod != "") {
                $this->Setlastmod($fild[$lastmod]);
            } else {
                $this->Setlastmod(date("Y-m-d"));
            }
            $this->SetChangeFreq("daily");
            $this->SetPriority("0.9");
        }
        $this->AddToSitemap();
        $this->paramval = [];
        $this->paramname = [];
        return $this;
    }

    public function MakeAndWriteSitemap()
    {
        $this->MakeSitemap();
        $this->WriteSitemap();
        return $this;
    }
}

?>