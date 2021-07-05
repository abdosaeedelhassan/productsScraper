<?php

namespace App\Http\Livewire\Amazon;

use App\Scrapers\AmazonScraper;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function doSearch()
    {
        AmazonScraper::getSearch($this->search);
        $this->emit('refreshProducts');
    }

    public function render()
    {
        return view('livewire.amazon.search');
    }
}
