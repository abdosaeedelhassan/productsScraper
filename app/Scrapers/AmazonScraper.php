<?php


namespace App\Scrapers;


use App\Models\Categories;
use App\Models\Products;
use Weidner\Goutte\GoutteFacade;

class AmazonScraper
{
    private static $base_url = 'https://www.amazon.com/';


    public static function getProductsCategories()
    {
        $crawler = GoutteFacade::request('GET', 'https://www.amazon.com/');
        $crawler->filter('.fluid-card')->each(function ($node) {
           // try {
                $name = $node->filter('.a-cardui-header')->filter('h2')->text();
                $url = $node->filter('.a-cardui-body')->filter('a')->attr('href');
                $image = $node->filter('.a-cardui-body')
                    ->filter('a')
                    ->filter('.fluid-image-container')
                    ->filter('img')->attr('src');
                Categories::create([
                    'name' => $name,
                    'image' => $image,
                    'url' => str_replace('/b?', 's?', $url)
                ]);
           // } catch (\Exception $exception) {
            //    var_dump($exception);
           // }
        });
    }


    public static function getTotalPages($category)
    {
        $category = str_replace('/b?', 's?', $category);
        $url = 'https://www.amazon.com/' . $category . '&fs=true';
        $crawler = GoutteFacade::request('GET', $url);
        $total_pages = 1;
        $pages = $crawler->filter('.a-pagination')->filter('li')->count();
        if ($pages > 0) {
            $pages = $crawler->filter('.a-pagination')->filter('li')->each(function ($node) {
                return $node->text();
            });
            $total_pages = $pages[sizeof($pages) - 2];
        }
        return $total_pages;
    }

    public static function getProducts($category_id, $page = 1)
    {
        $category = Categories::where('id', $category_id)->first();
        $url = 'https://www.amazon.com/' . $category->url . '&fs=true&page=' . $page;
        Products::where('category_id', $category_id)->delete();
        $crawler = GoutteFacade::request('GET', $url);
        return $crawler->filter('.s-result-item')->each(function ($node) use ($category_id) {
            //try {
                $image = $node->filter('img')->attr('src');
                $description = $node->filter('h2')->text();
                $price = $node->filter('.a-price')->filter('.a-offscreen')->text();
                $old_price = $node->filter('.a-text-price')->filter('.a-offscreen')->text();
                //$error_msg=$node->filter('img')->attr('src');
                // dd($node->html());
                Products::create([
                    'category_id' => $category_id,
                    'image' => $image,
                    'description' => $description,
                    'price' => $price,
                    'old_price' => $old_price,
                ]);
            //} catch (\Exception $exception) {
            //    //var_dump($exception);
            //}
        });
    }


}
