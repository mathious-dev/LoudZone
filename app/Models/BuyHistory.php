<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyHistory extends Model
{
    protected $fillable=['user_id',
    'user_name',
    'article_id',
    'article_title'];
}
