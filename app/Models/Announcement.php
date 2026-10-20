<?php

namespace App\Models;

use App\Models\BaseEntity;

class Announcement extends BaseEntity
{
    protected $fillable=['label',
    'content',
    'is_showing',
    'start_date',
    'end_date',];
    protected $nameValueColumn='label';
    protected $nameColumn="L'annonce";
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
}
