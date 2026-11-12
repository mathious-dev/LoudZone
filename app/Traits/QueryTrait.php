<?php

namespace App\Traits;

trait QueryTrait
{
    //par défaut on met à 10
    public function query($pagination=10,$withRelations = [], $orderByColumn = null, $orderDirection = 'desc')
    {
        $query=$this->model::query();
        if (!empty($withRelations))
            $query = $query->with($withRelations);

        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        $query=$this->searchCategoryFunction($query);
        $query=$this->searchBooleanFunction($query);
        $query=$this->searchRoleFunction($query);
        $query=$this->searchPriceFilterFunction($query);
        //Pour les listes de messages support et historique, ils doivent être trier du plus récent au plus ancien
        if($orderByColumn)
             return $query->orderBy($orderByColumn,$orderDirection)->paginate($pagination);
        return $query->paginate($pagination);
    }
    public function querySearch()
    {
        if (empty($this->search))
            return [];
        $query=$this->model::query();
        $query=$this->searchFunction($query);
        return $query->take(15)
                     ->get()
                     ->unique($this->searchWichColumn)
                     ->take(5)
                     ->values();
        //important values car unique garde les clés originales du tableau et values vient remettre tout au propre
    }
    public function otherQuery($class)
    {
        return $class::all();
    }
}
