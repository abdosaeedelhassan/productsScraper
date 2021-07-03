<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home')->withType('categories');
});

Route::get('/products/{category}', function ($category) {
    return view('home')->withType('products')->withCategory($category);
});


Route::get('/random', function () {
    //$categories=\App\Scrapers\AmazonScraper::getProducts('/b?node=16225007011');
    //return response()->json($categories);

    $url = "https://www.amazon.com/";

    $parser = new \App\Scrapers\HtmlParser($url);
    $items = $parser->getItemsByClass('.fluid-card');
    $categories = [];
    foreach ($items as $item) {
        array_push($categories, [
            'name' => $item->find('.a-cardui-header', 0)->find('h2', 0)->plaintext,
            'url' => $item->find('.a-cardui-body', 0)->find('a', 0)->href,
            'image' => $item->find('.a-cardui-body', 0)
                ->find('a', 0)
                ->find('.fluid-image-container', 0)
                ->find('img', 0)->src
        ]);
    }


    dd($categories);


});
