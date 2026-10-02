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
    'user_id_creator',
    'user_id_buyer',
    'article_category_id'];
    public function userCreator()
    {
        return $this->belongsTo(User::class,'user_id_creator');
    }
    public function userBuyer()
    {
        return $this->belongsTo(User::class,'user_id_buyer');
    }
    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
