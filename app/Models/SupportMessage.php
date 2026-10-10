<?php

namespace App\Models;

use App\Models\BaseEntity;

class SupportMessage extends BaseEntity
{
    protected $nameValueColumn='title';
    protected $nameColumn='le message support';
    protected $fillable=['title',
    'content',
    'user_id',
    'state',
    'support_message_category_id',
    'add_info_id'];
    //par défaut le message sera en attente
    protected $attributes = [
        'state' => false,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function supportMessageCategory()
    {
        return $this->belongsTo(SupportMessageCategory::class);
    }
    public function addInfo()
    {
        return $this->belongsTo(AddInfo::class);
    }
    public function changeState()
    {
        $this->state=true;//La demande est traitée
        $this->save();
    }
}
