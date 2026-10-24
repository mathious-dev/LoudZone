<?php

namespace App\Traits;

trait FilterTrait
{
    //La variable de recherche 
    public $search='';
    public $searchAscDesc='';
    public $searchCategory='';
    public $searchBoolean='';
    public $searchRole='';

    //La variable de la colonne de recherche
    public $searchWichColumn='';
    public $searchAscDescWichColumn='';
    public $searchCategoryWichColumn='';
    public $searchBooleanWichColumn='';

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
    
    public function searchBooleanFunction($query)
    {
        if (!empty($this->searchBoolean))
            return $query->where($this->searchBooleanWichColumn,$this->searchBoolean);
        return $query;
    }
    public function searchRoleFunction($query)
{
    if (!empty($this->searchRole)) 
    {
        return $query->whereHas('roles', function($q) {
            $q->where('id', $this->searchRole);
        });
    }
    return $query;
}
    public function deleteSearch()
    {
        $this->search='';
    }
    public function selectSearch($id)
    {
        $findObject=$this->model::find($id);
        if($findObject)
            $this->search=$findObject->{$this->searchWichColumn};//{} pour propriété dynamique sinon il ne comprend pas que c'est un $this->
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSearchAscDesc()
    {
        $this->resetPage();
    }
    public function updatedSearchCategory()
    {
        $this->resetPage();
    }
    public function updatedSearchBoolean()
    {
        $this->resetPage();
    }
    public function updatedSearchRole()
    {
        $this->resetPage();
    }
}
