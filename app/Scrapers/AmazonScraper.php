<?php


namespace App\Scrapers;


use Weidner\Goutte\GoutteFacade;

class AmazonScraper
{
    private static $base_url = 'https://www.amazon.com/';


    public static function getProductsCategories()
    {
        $crawler = GoutteFacade::request('GET', 'https://www.amazon.com/');
        return $crawler->filter('.fluid-card')->each(function ($node) {
            try {
                $name = $node->filter('.a-cardui-header')->filter('h2')->text();
                $url = $node->filter('.a-cardui-body')->filter('a')->attr('href');
                $image = $node->filter('.a-cardui-body')
                    ->filter('a')
                    ->filter('.fluid-image-container')
                    ->filter('img')->attr('src');
                return [
                    'name' => $name,
                    'image' => $image,
                    'url' => $url
                ];
            }catch (\Exception $exception){
                var_dump($exception);
            }
        });
    }


}
