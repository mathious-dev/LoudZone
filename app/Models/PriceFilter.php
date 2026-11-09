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
    public static function takeRealMaxAndMin($tabPriceFilter)
    {
        $max=null;
        $min=null;
        foreach($tabPriceFilter as $priceFilter)
        {
            if($priceFilter->max_price>$max)
                $max=$priceFilter->max_price;
            if($priceFilter->min_price<$min)
                $min=$priceFilter->min_price;
        }
        return [$max,$min];
    }
}
