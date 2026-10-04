<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=['title',
    'description',
    'price_ht',
    'slug',
    'stock',
    'is_published',
    'tva',
    'user_id',
    'article_category_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
    public function article_orders()
    {
        return $this->hasMany(ArticleOrder::class);
    }
}
