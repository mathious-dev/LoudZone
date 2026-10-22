<?php

namespace App\Models;

use App\Models\BaseEntity;
class CartItem extends BaseEntity
{
    protected $fillable=[
        'cart_id',
        'article_id',
        'quantity'
    ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
