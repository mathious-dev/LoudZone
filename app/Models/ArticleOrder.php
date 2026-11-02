<?php

namespace App\Models;

use App\Models\BaseEntity;



class ArticleOrder extends BaseEntity
{
    protected $nameColumn='id';
    protected $nameValueColumn='la commande article';
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
