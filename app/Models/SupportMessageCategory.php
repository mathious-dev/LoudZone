<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportMessageCategory extends BaseEntity
{
    protected $fillable=['label'];
    protected $nameColumn="La catégorie de message support";
    protected $nameValueColumn='label';
    public function addInfos()
    {
        return $this->belongsToMany(AddInfo::class,'add_info_by_categories','support_message_category_id','add_info_id');
    }
}
