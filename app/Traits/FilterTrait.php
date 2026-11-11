<?php

namespace App\Traits;

use App\Models\PriceFilter;

trait FilterTrait
{
    //La variable de recherche
    public $search='';
    public $searchAscDesc='';
    public $searchCategory='';
    public $searchBoolean='';
    public $searchRole='';
    public $tabListPriceFilterId=[];

    //La variable de la colonne de recherche
    public $searchWichColumn='';
    public $searchAscDescWichColumn='';
    public $searchCategoryWichColumn='';
    public $searchBooleanWichColumn='';
    public $searchPriceWichColumn='';

    //Le tableau de colonne de recherche possible
    public $tabSearchPossibility=[];
    public $tabSearchAscDescPossibility=[];
    public $tabSearchCategoryPossibility=[];

    public $showList=false;
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
        if ($this->searchBoolean!=='')
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
    public function searchPriceFilterFunction($query)
    {
        $listPriceFilter=null;
        if($this->tabListPriceFilterId)
        {
            $listPriceFilter=PriceFilter::whereIn('id',$this->tabListPriceFilterId)->get();
            $query->where(function ($subQuery) use ($listPriceFilter)
            {
                //On va appliquer la boucle dans le function afin de construire une requête complexe
                foreach ($listPriceFilter as $filter)
                {
                    //Si on est au premier tour Laravel transforme le orWhere en where classique
                    //Si c'est le 2eme tour il va appliquer le orWhere plutôt qu'un simple where
                    //Chaque function est comme une parenthèse en SQL chaque condition sera dans sa parenthèse avec un OR entre les parenthèses
                    $subQuery->orWhere(function ($q) use ($filter)
                    {
                        //le q c'est le builder et le filter vient de la liste qu'on a récupéré avec les données
                        if (!is_null($filter->min_price))
                            $q->where($this->searchPriceWichColumn, '>=', $filter->min_price);

                        if (!is_null($filter->max_price))
                            $q->where($this->searchPriceWichColumn, '<=', $filter->max_price);
                    });
                }
            });
        }
        return $query;
    }
    public function deleteSearch()
    {
        $this->search='';
        $this->showList=false;
    }
    public function selectSearch($id)
    {
        $findObject=$this->model::find($id);
        if($findObject)
        {
            $this->search=$findObject->{$this->searchWichColumn};//{} pour propriété dynamique sinon il ne comprend pas que c'est un $this->
            $this->showList=false;
        }
    }
    public function updatedSearch()
    {
        if (!empty($this->search))
            $this->showList = true;
        else
            $this->showList = false;
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
    public function updatedTabListPriceFilterId()
    {
        $this->resetPage();
    }
}
