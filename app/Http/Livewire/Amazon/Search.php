<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Search extends Component
{
    public $search;


    public function doSearch(){

    }

    public function render()
    {
        return view('livewire.amazon.search');
    }
}
