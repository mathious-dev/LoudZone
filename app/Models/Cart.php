<?php

namespace App\Models;

use App\Models\BaseEntity;
class Cart extends BaseEntity
{
    protected $nameValueColumn='id';
    protected $nameColumn="le panier";
    protected $fillable=[
        'is_payed',
        'user_id',
        'session_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
