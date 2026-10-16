<?php

namespace App\Traits;

trait FilterTrait
{
    //La variable de recherche 
    public $search='';
    public $searchAscDesc='';
    public $searchCategory='';

    //La variable de la colonne de recherche
    public $searchWichColumn='';
    public $searchAscDescWichColumn='';
    public $searchCategoryWichColumn='';

    //Le tableau de colonne de recherche possible
    public $tabSearchPossibility=[];
    public $tabSearchAscDescPossibility=[];
    public $tabSearchCategoryPossibility=[];

    public function searchFunction($query)
    {
        if(!empty($this->search)&& !empty($this->searchWichColumn))
        {
            if($this->searchWichColumn=='user_id')
                return $query->whereHas('user',function($q){
                $q->where('name','like','%'.$this->search.'%');
                });
            else
                return $query->where($this->searchWichColumn ,'like','%'.$this->search.'%');
        }
        return $query;
    }
    public function searchAscDescFunction($query)
    {
        if(!empty($this->searchAscDesc))
            return $query->orderBy($this->searchAscDescWichColumn,$this->searchAscDesc);
        return $query;
    }
    public function searchCategoryFunction($query)
    {
        if(!empty($this->searchCategory))
            return $query->where($this->searchCategoryWichColumn,$this->searchCategory);
        return $query;
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSearchAscDesc()
    {
        $this->resetPage();
    }
}
