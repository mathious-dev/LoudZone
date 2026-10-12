<?php

namespace App\Models;

use App\Models\BaseEntity;


class Payment extends BaseEntity
{
    protected $nameValueColumn='transaction_id';
    protected $nameColumn='le paiement';
    protected $fillable = [
        'amount',
        'state',
        'transaction_id',
        'payment_method',
        'order_id'
    ];
    protected $attributes=['state'=>false];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
