<?php

namespace App\Models;

use App\Models\BaseEntity;
use App\Models\Category;
use App\Models\SupportMessage;


class AddInfo extends BaseEntity
{
    protected $nameColumn='label';
    protected $nameValueColumn="L'information suuplémentaire";
    protected $fillable=['label'];
    public function categories()
    {
        return $this->belongsToMany(Category::class,'add_info_by_categories','add_info_id','category_id');
    }
    public function supportMessages()
    {
        return $this->belongsToMany(SupportMessage::class,'support_message_add_infos','add_info_id','support_message_id');
    }
}
