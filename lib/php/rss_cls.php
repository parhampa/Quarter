<?php

class rss_cls
{
    private $rss_title = "";
    private $rss_lang = "";
    private $rss_description = "";
    private $rss_generator = "";
    private $rss_admin = "";
    private $res_table = "";

    public function set_rss_detail($title, $lang, $description, $generator, $admin)
    {
        $this->rss_title = $title;
        $this->rss_lang = $lang;
        $this->rss_description = $description;
        $this->rss_generator = $generator;
        $this->rss_admin = $admin;
        return $this;
    }

    public function res_table_rss($table, $title, $page, $id, $time, $count)
    {
        $sql = "select * from `$table` order by `id` desc limit 0,$count";
        $db = new database();
        $db->connect()->query($sql);
        if (mysqli_num_rows($db->res) > 0) {
            while ($fild = mysqli_fetch_assoc($db->res)) {
                $this->res_table .= @'<item>' . PHP_EOL . '<title>' . PHP_EOL . $fild[$title] . PHP_EOL . '</title>' . PHP_EOL . '<link>' . $GLOBALS['web_url'] . $page . "?$id=" . $fild[$id] . '</link>' . PHP_EOL . '<dc:creator>' . $this->rss_admin . '</dc:creator>' . PHP_EOL . '<pubDate> ' . date(DATE_RFC822, strtotime($fild[$time])) . '</pubDate>' . PHP_EOL . '</item>' . PHP_EOL;

            }
        }
        return $this;
    }

    public function make_rss($file)
    {
        $resxml = '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
        $resxml .= '<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:turbo="http://turbo.yandex.ru" version="2.0">' . PHP_EOL;
        $resxml .= '<channel>' . PHP_EOL;
        $resxml .= '<title>' . $this->rss_title . '</title>' . PHP_EOL;
        $resxml .= '<link>' . $GLOBALS['web_url'] . ' </link> ' . PHP_EOL;
        $resxml .= '<language>' . $this->rss_lang . '</language>' . PHP_EOL;
        $resxml .= '<description>' . $this->rss_title . '</description>' . PHP_EOL;
        $resxml .= '<generator>' . $this->rss_generator . '</generator>' . PHP_EOL;
        $resxml .= $this->res_table;
        $resxml .= '</channel>' . PHP_EOL;
        $resxml .= '</rss>';

        $myfile = fopen($file, "wr") or die("Unable to open file!");
        fwrite($myfile, $resxml);
        fclose($myfile);

    }
}

?>