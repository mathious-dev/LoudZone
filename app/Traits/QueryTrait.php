<?php

namespace App\Traits;

trait QueryTrait
{
    //par défaut on met à 10
    public function query($pagination=10,$withRelations = [])
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
