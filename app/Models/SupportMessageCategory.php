<?php

namespace App\Models;

use App\Models\SupportMessage;

class SupportMessageCategory extends BaseEntity
{
    protected $fillable=['label'];
    protected $nameColumn="La catégorie de message support";
    protected $nameValueColumn='label';
    public function addInfos()
    {
        return $this->belongsToMany(AddInfo::class,'add_info_by_categories','support_message_category_id','add_info_id');
    }
    public function supportMessages()
    {
        return $this->hasMany(SupportMessage::class);
    }
}
