<?php

namespace App\Livewire\public\cart;

use App\Livewire\PublicComponent;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Services\CartService;

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
    public function deleteItems($cartId)
    {
        $cart=Cart::find($cartId);
        if($cart)
        {
            $cart->cartItems()->delete();
            saveHistory("Suppression de tous les articles dans le panier $cartId de {$cart->user->name}");
        }
    }
    public function deleteItem($cartItemId)
    {
        $cartItem=CartItem::find($cartItemId);
        if($cartItem)
        {
            $cartItem->delete();
            saveHistory("Suppression de l'article $cartItem->article_id du panier $cartItem->cart_id");
        }
    }
    public function addOrRemoveItem(CartService $CartService,CartItem $cartItem,$quantity=1)
    {
        $CartService->changeQuantity($cartItem,$quantity);
    }
}
