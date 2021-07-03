<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Dashbaord extends Component
{

    public $display='categories';



    public function render()
    {
        return view('livewire.amazon.dashbaord');
    }
}
