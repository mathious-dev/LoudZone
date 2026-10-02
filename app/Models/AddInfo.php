<?php

namespace App\Models;

use App\Models\SupportMessage;
use Illuminate\Database\Eloquent\Model;

class AddInfo extends Model
{
    protected $fillable=['label'];
    public function supportMessages()
    {
        return $this->hasMany(SupportMessage::class);
    }
    public function addInfoByCategories()
    {
        return $this->hasMany(AddInfoByCategory::class);
    }
}
