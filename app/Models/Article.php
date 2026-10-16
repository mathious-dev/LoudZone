<?php

namespace App\Models;

use App\Models\BaseEntity;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Casts\Attribute;


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
    'primary_image',
    'promotion_id',
    'final_price'
    ];
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
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
    public function changeStatePublishArticleModel()
    {
        $this->is_published = !$this->is_published;
        $this->save();
    }
    public function priceWithTva():Attribute
    {
        return Attribute::make(get:function(){
            //calcul de tva où l'on multiplie le prix HT par 1,21 par exemple
            return round($this->price_ht * (1 + ($this->tva / 100)), 2);
        });
    }
    protected static function booted()
    {
        static::saving(function (Article $article)
        {
            if($article->promotion)
                $article->final_price=round($article->priceWithTva*(1-($article->promotion->amount)/100),2);
            else
                $article->final_price=$article->price_with_tva;
        });
    }
}
