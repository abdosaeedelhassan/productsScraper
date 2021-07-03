<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Products extends Component
{
    public $selected_category;
    public $categories = [];
    public $products = [];

    public function mount($category)
    {
        $this->selected_category = $this->getCategory($category);
        $this->getProducts();
    }


    private function getCategory($id)
    {
        return \App\Models\Categories::where('id', $id)->first();
    }

    public function getProducts()
    {
        if ($this->selected_category) {
            $this->products = \App\Models\Products::where('category_id', $this->selected_category->id)->get();
        }
    }

    public function refreshProducts()
    {
        \App\Scrapers\AmazonScraper::getProducts($this->selected_category->id);
        $this->getProducts();
    }

    public function setCategory($id)
    {
        $this->selected_category = $this->getCategory($id);
        $this->getProducts();
    }

    public function render()
    {
        return view('livewire.amazon.products');
    }
}
