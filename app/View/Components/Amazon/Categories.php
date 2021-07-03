<?php

namespace App\View\Components\Amazon;

use Illuminate\View\Component;

class Categories extends Component
{
    public $categories=[];

    public function openCategory($name){
        $this->redirect('/products/'.str_replace('/','',$name));
    }

    public function __construct()
    {
        $this->categories=\App\Scrapers\AmazonScraper::getProductsCategories();
    }

    public function render()
    {
        return view('components.amazon.categories');
    }
}
