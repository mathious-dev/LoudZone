<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseEntity
{
    protected $nameValueColumn='title';
    protected $nameColumn="L'article";
    protected $fillable=['title',
    'description',
    'price_ht',
    'slug',
    'stock',
    'is_published',
    'tva',
    'user_id',
    'article_category_id',
    'primary_image'];
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
    //On met la relation au pluriel et morphMany pour dire qu'il y a plusieurs images
    //On met le préfixe imageable pour guider la recherche et dire à laravel de chercher les colonnes commençant par ce préfixe
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
