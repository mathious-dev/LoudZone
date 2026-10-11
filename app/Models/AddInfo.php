<?php

namespace App\Models;

use App\Models\BaseEntity;
use App\Models\SupportMessage;


class AddInfo extends BaseEntity
{
    protected $nameValueColumn='label';
    protected $nameColumn="L'information suuplémentaire";
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
