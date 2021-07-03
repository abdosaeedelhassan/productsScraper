<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Categories extends Component
{
    public $categories=[];


    public function mount(){
        $this->getCategories();
    }

    public function refreshCategories(){
        \App\Scrapers\AmazonScraper::getProductsCategories();
        $this->getCategories();
    }

    public function getCategories()
    {
        $this->categories=\App\Models\Categories::all();
    }

    public function openCategory($name){
       $this->redirect('/products/'.str_replace('/','',$name));
    }

    public function render()
    {
        return view('livewire.amazon.categories');
    }
}
