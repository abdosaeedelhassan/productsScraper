<?php


namespace App\Scrapers;


use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Weidner\Goutte\GoutteFacade;

class AmazonScraper
{
    private static $base_url = 'https://www.amazon.sa/-/ar/';


    public static function getProductsCategories()
    {
        $parser = new \App\Scrapers\HtmlParser(self::$base_url);
        $items = $parser->getItemsByClass('.fluid-card');

        DB::table('categories')->delete();

        foreach ($items as $item) {
            $name = null;
            if ($item->find('.a-cardui-header', 0)) {
                $name = $item->find('.a-cardui-header', 0)->find('h2', 0)->plaintext;
            }
            $url = null;
            if ($item->find('.a-cardui-body', 0)) {
                $url = $item->find('.a-cardui-body', 0)->find('a', 0)->href;
            }
            $image = null;
            if ($item->find('.a-cardui-body', 0)) {
                $image = $item->find('.a-cardui-body', 0)
                    ->find('a', 0)
                    ->find('.fluid-image-container', 0)
                    ->find('img', 0)->src;
            }
            if ($name && $image && $url) {
                Categories::create([
                    'name' => $name,
                    'image' => $image,
                    'url' => str_replace('/b?', 's?', $url)
                ]);
            }
        }
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
        DB::table('products')->where('category_id', $category_id)->delete();

        $category = Categories::where('id', $category_id)->first();
        $parser = new \App\Scrapers\HtmlParser(self::$base_url . $category->url . '&fs=true&page=' . $page);
        $items = $parser->getItemsByClass('.s-result-item');

        foreach ($items as $item) {
            $image = null;
            if ($item->find('img', 0)) {
                $image = $item->find('img', 0)->src;
            }
            $description = null;
            if ($item->find('h2', 0)) {
                $description = $item->find('h2', 0)->plaintext;
            }
            $price = null;
            if ($item->find('.a-price', 0)) {
                $price = $item->find('.a-price', 0)->find('.a-offscreen', 0)->plaintext;
            }
            $old_price = $price;
            if ($item->find('.a-text-price', 0)) {
                $old_price = $item->find('.a-text-price', 0)->find('.a-offscreen', 0)->plaintext;
            }
            if ($image && $description && $price) {
                Products::create([
                    'category_id' => $category_id,
                    'image' => $image,
                    'description' => $description,
                    'price' => str_replace('ريال', '', $price),
                    'old_price' => str_replace('ريال', '', $old_price),
                ]);
            }
        }

    }


    public static function getSearch($search, $page = 1)
    {
        $query=self::$base_url . 's?k='.$search.'&ref=nb_sb_noss' . '&page=' . $page;
        $parser = new \App\Scrapers\HtmlParser($query);
        $items = $parser->getItemsByClass('.s-result-item');

        $result=[];

        foreach ($items as $item) {
            $image = null;
            if ($item->find('img', 0)) {
                $image = $item->find('img', 0)->src;
            }
            $description = null;
            if ($item->find('.a-text-normal', 1)) {
                $description = $item->find('.a-text-normal',1)->plaintext;
            }
            $price = null;
            if ($item->find('.a-price-whole', 0)) {
                $price = $item->find('.a-price-whole', 0)->plaintext;
            }
            $old_price = $price;
            if ($item->find('.a-offscreen', 1)) {
                $old_price = $item->find('.a-offscreen',1)->plaintext;
            }
            if ($image && $description && $price) {
               array_push($result,[
                   'image' => $image,
                   'description' => $description,
                   'price' => str_replace('ريال', '', $price),
                   'old_price' => str_replace('ريال', '', $old_price),
               ]);
            }
        }

        return $result;
    }



}
