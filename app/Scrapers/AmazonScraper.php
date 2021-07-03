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


    public static function getTotalPages($category){
        $category=str_replace('/b?','s?',$category);
        $url='https://www.amazon.com/'.$category.'&fs=true';
        $crawler = GoutteFacade::request('GET', $url);
        $total_pages=1;
        $pages=$crawler->filter('.a-pagination')->filter('li')->count();
        if ($pages>0){
            $pages=$crawler->filter('.a-pagination')->filter('li')->each(function ($node){
                return $node->text();
            });
            $total_pages=$pages[sizeof($pages)-2];
        }
        return $total_pages;
    }

    public static function getProducts($category,$page=1)
    {
        $category=str_replace('/b?','s?',$category);
        $url='https://www.amazon.com/'.$category.'&fs=true&page='.$page;
        $crawler = GoutteFacade::request('GET', $url);
        return $crawler->filter('.s-result-item')->each(function ($node) {
            $image='';
            $description='';
            $price='';
            $old_price='';
            try {
                $image=$node->filter('img')->attr('src');
                $description=$node->filter('h2')->text();
                $price=$node->filter('.a-price')->filter('.a-offscreen')->text();
                $old_price=$node->filter('.a-text-price')->filter('.a-offscreen')->text();
                //$error_msg=$node->filter('img')->attr('src');
                // dd($node->html());
                return [
                    'image' => $image,
                    'description' => $description,
                    'price'=>$price,
                    'old_price'=>$old_price,
                    //'error_msg'=>$error_msg
                ];
            }catch (\Exception $exception){
                return [
                    'image' => $image,
                    'description' => $description,
                    'price'=>$price,
                    'old_price'=>$old_price,
                    //'error_msg'=>$error_msg
                ];
                //var_dump($exception);
            }
        });
    }


}
