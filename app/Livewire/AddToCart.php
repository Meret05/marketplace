<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $justAddedVariationId = null;
    public $variation;

    public function mount($variation)
    {
        $this->variation = $variation;
    }

    public function addToCart()
    {
        Cart::add($this->variation->id);

        $this->justAddedVariationId = $this->variation->id;
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
