<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $fillable=['title',
    'content',
    'user_id',
    'add_info_id',
    'category_message_support_id'];
}
