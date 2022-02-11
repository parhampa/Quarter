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
        $this->loc = $var;
        return $this;
    }

    public function lastmod($lastmod)
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
}

?>