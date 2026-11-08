<?php

namespace App\Models;

use App\Models\Article;
use App\Models\BaseEntity;


class Promotion extends BaseEntity
{
    protected $nameColumn='label';
    protected $nameValueColumn="La promotion";
    protected $fillable = [
        'label',
        'amount',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'amount'     => 'decimal:2'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public static function  booted()
    {
        static::deleting(function (Promotion $promotion)
        {
            $listArticles=Article::where('promotion_id',$promotion->id)->get();
            foreach($listArticles as $article)
            {
                //On met manuellement la promotion à null car l'article possède aussi un événement de modèle avec saving
                $article->promotion_id=null;
                $article->final_price=$article->priceWithTva();
                $article->save();
            }
        });

    }
}
