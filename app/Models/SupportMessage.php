<?php

namespace App\Models;

use App\Models\BaseEntity;
use App\Models\Category;

class SupportMessage extends BaseEntity
{
    protected $nameColumn='title';
    protected $nameValueColumn='le message support';
    protected $fillable=['title',
    'content',
    'user_id',
    'state',
    'category_id',
    'add_info_id'];
    //par défaut le message sera en attente
    protected $attributes = [
        'state' => false,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
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
