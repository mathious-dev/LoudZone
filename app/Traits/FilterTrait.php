<?php

namespace App\Traits;

trait FilterTrait
{
    public function search($search,$query,$column)
    {
        return $query->where($column ,'like','%'.$search.'%');
    }
}
