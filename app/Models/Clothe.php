<?php

namespace App\Models;

use App\Models\BaseEntity;

class Clothe extends BaseEntity
{
    //On dit bien à laravel que c'est plus id mais article_id
    protected $primaryKey = 'article_id';
    //On ne doit plus incrémenter comme son id est l'id de l'article
    public $incrementing = false;
    protected $fillable=[
        'article_id',
        'size'
    ];
    public function article()
    {
        return $this->belongsTo(Article::class,'article_id');
    }
    public function getSize()
    {
        return ['XS','S','M','L','XL','XXL'];
    }
}
