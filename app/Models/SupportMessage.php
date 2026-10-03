<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $fillable=['title',
    'content',
    'user_id',
    'support_message_cateogry_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supportMessageCategory()
    {
        return $this->belongsTo(SupportMessageCategory::class);
    }
    public function addInfos()
    {
        return $this->belongsToMany(AddInfo::class,'support_message_add_infos','support_message_id','add_info_id');
    }
}
