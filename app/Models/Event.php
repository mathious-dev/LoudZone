<?php

namespace App\Models;

use App\Models\Address;
use App\Models\BaseEntity;


class Event extends BaseEntity
{
    protected $fillable=['label',
    'description',
    'start_date',
    'end_date',
    'address_id'];
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
