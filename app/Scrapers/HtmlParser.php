<?php


namespace App\Scrapers;


class HtmlParser
{
    private $url;

    public function __construct($url)
    {
        $this->url=$url;
    }

    public function getContent(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_REFERER, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
        $result = curl_exec($ch);
        curl_close($ch);
        return str_get_html($result);
    }

    public function getItemsByClass($class){
        return  $items = $this->getContent()->find($class);
    }


}
