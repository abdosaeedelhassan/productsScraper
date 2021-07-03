<?php

namespace App\Http\Livewire\Amazon;

use App\Scrapers\AmazonScraper;
use Livewire\Component;

class Products extends Component
{
    public $selected_category;
    public $categories = [];
    public $products = [];

    public function mount($category)
    {
        $this->selected_category =  $category;
    }


    public function getProducts()
    {
        $this->categories = \App\Scrapers\AmazonScraper::getProductsCategories();
        $this->setCategory($this->selected_category);
    }

    public function setCategory($url)
    {
        $this->selected_category = $url;
        $this->products=[];
        $this->products = \App\Scrapers\AmazonScraper::getProducts($this->selected_category);
    }

    public function render()
    {
        return view('livewire.amazon.products');
    }
}
