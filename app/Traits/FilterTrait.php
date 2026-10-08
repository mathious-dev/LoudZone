<?php

namespace App\Traits;

trait FilterTrait
{
    public $search='';
    public $searchWichColumn='';
    public $tabSearchPossibility=[];
    public function search($query)
    {
        if(!empty($this->search)&& !empty($this->searchWichColumn))
            return $query->where($this->searchWichColumn ,'like','%'.$this->search.'%');
        return $query;
    }
}
