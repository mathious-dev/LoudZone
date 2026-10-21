<?php

namespace App\Livewire\public\cart;

use App\Livewire\PublicComponent;
use App\Models\Cart;
use App\Models\User;

class CartList extends PublicComponent
{
    public $user;
    public $cart;
    public $listArticleItems;
    public $model=Cart::class;
    public function render()
    {
        return view('livewire.public.cart.cart-list',['cart'=>$this->cart]);
    }
    public function mount($userId)
    {
        $this->user=User::find($userId);
        $this->cart=$this->user->carts()->where('is_payed',false)->first();
    }
}
