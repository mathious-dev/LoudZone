<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleOrder extends Model
{
    protected $fillable = [
        'quantity',
        'unit_price',
        'article_id',
        'order_id'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
