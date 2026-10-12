<?php

namespace App\Models;

use App\Models\BaseEntity;
use App\Models\Event;

class Address extends BaseEntity
{
    protected $fillable=['city',
    'postal_code',
    'street'];
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
