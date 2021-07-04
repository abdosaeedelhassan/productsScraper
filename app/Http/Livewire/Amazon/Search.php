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
        $this->result = AmazonScraper::getSearch($this->search);
    }

    public function render()
    {
        return view('livewire.amazon.search');
    }
}
