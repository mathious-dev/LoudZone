<?php

namespace App\Models;

use App\Models\BaseEntity;
class PriceFilter extends BaseEntity
{
    protected $nameColumn='label';
    protected $nameValueColumn="Le filtre de prix";
    protected $fillable=['label',
    'max_price',
    'min_price',
    'is_active'];
}
