<?php

namespace App\Traits;

trait FilterTrait
{
    public $search='';
    public $searchAscDesc='';
    public $searchWichColumn='';
    public $searchAscDescWichColumn='';
    public $tabSearchPossibility=[];
    public $tabSearchAscDescPossibility=[];
    public function search($query)
    {
        if(!empty($this->search)&& !empty($this->searchWichColumn))
            return $query->where($this->searchWichColumn ,'like','%'.$this->search.'%');
        return $query;
    }
    public function searchAscDesc($query)
    {
        if(!empty($this->searchAscDesc))
        {
            if($this->searchAscDesc=='asc')
                return $query->orderBy($this->searchAscDescWichColumn,'asc');
            else
                return $query->orderBy($this->searchAscDescWichColumn,'desc');
        }
        return $query;
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
}
