<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
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
