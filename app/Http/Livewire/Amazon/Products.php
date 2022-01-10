<?php

namespace App\Http\Livewire\Amazon;

use Livewire\Component;

class Products extends Component
{
    public $products = [];

    protected $listeners = ['refreshProducts' => 'getProducts'];

    public function getProducts()
    {
        $this->products = \App\Models\Products::all();
    }

    public function render()
    {
        return view('livewire.amazon.products');
    }
}
