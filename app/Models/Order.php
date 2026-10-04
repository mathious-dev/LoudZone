<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'state',
        'total_price',
        'user_id'
    ];
    public function articleOrders()
    {
        return $this->hasMany(ArticleOrder::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
