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
    $category='b'.str_replace(request()->url(),'',request()->fullUrl());
    return view('home')->withType('products')->withCategory($category);
});


Route::get('/random', function () {
    $categories=\App\Scrapers\AmazonScraper::getProducts('/b?node=16225007011');
    return response()->json($categories);
});
