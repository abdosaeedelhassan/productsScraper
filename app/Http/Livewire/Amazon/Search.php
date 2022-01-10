<?php

namespace App\Http\Livewire\Amazon;

use App\Scrapers\AmazonScraper;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public $search_keywords;

    public $search_hours;
    public $search_minutes;

    public function mount(){
        $this->fill(getSetting([
            'search_keywords',
            'search_hours',
            'search_minutes'
        ]));
    }


    public function doSearch()
    {
        $this->validate([
            'search' => 'required'
        ]);

        AmazonScraper::getSearch($this->search);
        $this->emit('refreshProducts');
    }

    public function saveSettings(){

        saveSetting('search_keywords',$this->search_keywords);
        saveSetting('search_hours',$this->search_hours);
        saveSetting('search_minutes',$this->search_minutes);



        session()->flash('message', 'Post successfully updated.');
    }

    public function render()
    {
        return view('livewire.amazon.search');
    }
}
