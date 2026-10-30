<?php

namespace App\Models;

use App\Models\Address;
use App\Models\BaseEntity;


class Event extends BaseEntity
{
    protected $nameValueColumn='label';
    protected $nameColumn="l'événement";
    protected $fillable=['label',
    'description',
    'start_date',
    'end_date',
    'is_important',
    'primary_image',
    'address_id'];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function publishOrNot()
    {
        $this->is_important=!$this->is_important;
        $this->save();
    }
    public static function booted()
    {
        static::saving(function($event)
        {
            if($event->is_important)
            {
                Event::where('is_important',true)->update(['is_important'=>false]);
                saveHistory("événement $event->label est publié");
            }
        });
    }
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
