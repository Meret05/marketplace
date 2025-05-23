<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartList extends Component
{
    public $items = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->items = Cart::get();
        $this->total = Cart::total();
    }

    public function increment($id)
    {
        $cartItem = Cart::findOrFail($id);
        Cart::quantity($id, $cartItem->quantity + 1);
        $this->loadCart();
    }

    public function decrement($id)
    {
        $cartItem = Cart::findOrFail($id);
        Cart::quantity($id, $cartItem->quantity - 1);
        $this->loadCart();
    }

    public function updateQuantity($id, $quantity)
    {
        Cart::quantity($id, (int) $quantity);
        $this->loadCart();
    }

    public function remove($id)
    {
        Cart::remove($id);
        $this->loadCart();
    }

    public function flushCart()
    {
        Cart::flush();
        $this->loadCart();
    }

    public function getTotalProperty()
    {
        return Cart::total();
    }

    public function render()
    {
        return view('livewire.cart-list');
    }
}
