<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
        $this->dispatch('refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
        $this->dispatch('refreshComponent');
    }

    public function destroy($id)
    {
        Cart::remove($id);
        $this->dispatch('refreshComponent');
        session()->flash('success_message','Item has been removed!');

    }

    public function clearAll()
    {
        Cart::destroy();
        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout("layouts.app");
    }
}
