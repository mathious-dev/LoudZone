<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends BaseEntity
{
    protected $nameValueColumn='label';
    protected $nameColumn="La catégorie d'article";
    protected $fillable=['label'];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
