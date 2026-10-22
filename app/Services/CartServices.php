<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartServices
{
    public function AddArticleInCart($articleId,$quantity=1)
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
            $this->changeQuantity($cartItem,$quantity);
        else
        {
            if($quantity>0) //si la quantité est positive
            {
                CartItem::create(['cart_id'=>$cart->id,'article_id'=>$articleId,'quantity'=>$quantity]);
                saveHistory("Ajout d'un nouvel article $articleId pour le panier $cart->id");
            }
        }
    }
    public function changeQuantity(CartItem $cartItem,$quantity)
    {
        $newQuantity=$cartItem->quantity + $quantity;
        if($newQuantity>0)
        {
            $cartItem->increment('quantity',$quantity);
            $action = $quantity > 0 ? "Ajout" : "Retrait";
            $value = abs($quantity); // Enlève le signe "moins" pour le texte
            saveHistory("$action de $value en plus pour l'article id {$cartItem->article_id} dans le panier {$cartItem->cart_id}");
        }
        else
        {
            $cartItem->delete();
            saveHistory("Suppression de l'article $cartItem->article_id du panier {$cartItem->cart_id}");
        }
    }
}