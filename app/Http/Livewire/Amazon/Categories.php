<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Categories extends Component
{
    public $categories=[];
    public function getCategories()
    {
        $this->categories=\App\Scrapers\AmazonScraper::getProductsCategories();
    }

    public function openCategory($url){
        dd($url);
    }

    public function render()
    {
        return view('livewire.amazon.categories');
    }
}
