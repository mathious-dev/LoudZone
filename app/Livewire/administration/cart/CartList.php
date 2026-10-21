<?php

namespace App\Livewire\administration\cart;

use App\Livewire\AdminComponent;
use App\Models\Cart;

class CartList extends AdminComponent
{
    public $model=Cart::class;
    public function render()
    {
        return view('livewire.administration.cart.cart-list',['listCarts'=>$this->query(10)]);
    }
    public function mount()
    {

    }
}
