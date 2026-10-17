<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable=['label',
    'content',
    'is_showing',
    'start_date',
    'end_date',];
}
