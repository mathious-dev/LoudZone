<?php

namespace App\Models;

use App\Models\Article;
use App\Models\BaseEntity;


class Promotion extends BaseEntity
{
    protected $nameValueColumn='id';
    protected $nameColumn="l'Id";
    protected $fillable = [
        'label',
        'amount',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'amount'     => 'decimal:2'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
