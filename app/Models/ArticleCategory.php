<?php

namespace App\Models;

use App\Models\BaseEntity;

class ArticleCategory extends BaseEntity
{
    protected $nameValueColumn='label';
    protected $nameColumn="La catégorie d'article";
    protected $fillable=['label'];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public static function isClotheCategory($id)
    {
        if (!$id) 
            return false;
        $category=ArticleCategory::find($id);
        if ($category) 
            return $category->label === 'Vêtement';
        return false;
    }
}
