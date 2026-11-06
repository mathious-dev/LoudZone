<?php

namespace App\Models;

use App\CategoryEnum;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['label','type'];
    protected $nameValueColumn="La catégorie";
    protected $nameColumn='label';
    //protection
    protected $casts = [
        'type' => CategoryEnum::class,
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function addInfos()
    {
        return $this->belongsToMany(AddInfo::class,'add_info_by_categories','support_message_category_id','add_info_id');
    }
    public function supportMessages()
    {
        return $this->hasMany(SupportMessage::class);
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
    // public static function isClotheCategory($id)
    // {
    //     if (!$id) 
    //         return false;
    //     $category=ArticleCategory::find($id);
    //     if ($category) 
    //         return $category->label === 'Vêtement';
    //     return false;
    // }
}

