<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartServices
{
    public function AddArticleInCart($articleId,$quantity)
    {
        //Utilisateur connecté
        if(Auth::check())
        {
            $cart=auth()->user()->carts()->where('is_payed',false)->first();
            if(!$cart)
            {
                $cart=Cart::create(['user_id'=>auth()->id()]);
                saveHistory("Création d'un panier");
            }
        }
        //Visiteur
        else
        {
            $cart=Cart::where('session_id', session()->getId())->where('is_payed', false)->first();
            if(!$cart)
                $cart=Cart::create(['session_id'=>session()->getId(),'user_id'=>null]);//sécurité de user_id en null pour être sûr que le cart n'est lié à personne
        }     
        $cartItem=CartItem::where('article_id',$articleId)->where('cart_id',$cart->id)->first();
        if($cartItem)
        {
            $newQuantity=$cartItem->quantity + $quantity;
            if($newQuantity>0)
            {
                $cartItem->increment('quantity',$quantity);
                saveHistory("Ajout de $quantity en plus pour l'article id $articleId dans le panier $cart->id");
            }
            else
            {
                $cartItem->delete();
                saveHistory("Suppression du CartItem $cartItem->id du panier $cart->id");
            }
        }
        else
        {
            $this->createCartItem($articleId,$quantity,$cart);
            saveHistory("Création de CartItem pour le panier $cart->id");
        }
            
    }
    public function createCartItem($articleId,$quantity,$cart)
    {
        CartItem::create(['cart_id'=>$cart->id,'article_id'=>$articleId,'quantity'=>$quantity]);
    }
}