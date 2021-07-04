<?php

namespace App\Http\Livewire\Amazon;

use App\Scrapers\AmazonScraper;
use Livewire\Component;

class Search extends Component
{
    public $search;


    public $result;


    public function doSearch()
    {
        AmazonScraper::getSearch($this->search);
        $this->result = \App\Models\Products::all();
    }

    public function render()
    {
        return view('livewire.amazon.search');
    }
}
