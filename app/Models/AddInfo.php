<?php

namespace App\Models;

use App\Models\SupportMessage;
use Illuminate\Database\Eloquent\Model;

class AddInfo extends Model
{
    protected $fillable=['label'];
    public function supportMessageCategories()
    {
        return $this->belongsToMany(SupportMessageCategory::class,'add_info_by_categories','add_info_id','support_message_category_id');
    }
    public function supportMessages()
    {
        return $this->belongsToMany(SupportMessage::class,'support_message_add_infos','add_info_id','support_message_id');
    }
}
