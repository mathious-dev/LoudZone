<?php

namespace App\Models;

use App\Enum\CategoryEnum;
use App\Models\BaseEntity;

class Announcement extends BaseEntity
{
    protected $fillable=['label',
    'content',
    'is_showing',
    'start_date',
    'end_date',
    'category_id'];
    protected $nameColumn='label';
    protected $nameValueColumn="L'annonce";
    //sécurité pour pouvoir comparer en type de date
    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
    ] ;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected static function booted()
    {
        static::saving(function(Announcement $announcement)
        {
            if($announcement->is_showing)
            {
                Announcement::where('is_showing', true)->update(['is_showing' => false]);
                saveHistory("Annonce $announcement->label publiée");
            }
        });
    }
    public function IsDateCorrect($start,$end)
    {
        if($end)
        {
            if($start<=$end)
                return true;
            return false;
        }
        return true;
    }
    public function removePublishModel()
    {
        $this->is_showing=false;
        saveHistory("Dépublication de l'annonce : {$this->label}");
        $this->save();
    }
    public static function getCategoryForAnnouncement()
    {
        return Category::where('type',CategoryEnum::ANNOUNCE)->get();
    }
}
