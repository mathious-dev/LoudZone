<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable=['label',
    'content',
    'start_date',
    'end_date',];
}
