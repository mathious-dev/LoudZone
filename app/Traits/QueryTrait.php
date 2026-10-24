<?php

namespace App\Traits;

trait QueryTrait
{
    //par défaut on met à 10
    public function query($pagination=10)
    {
        $query=$this->model::query();
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        $query=$this->searchCategoryFunction($query);
        $query=$this->searchBooleanFunction($query);
        $query=$this->searchRoleFunction($query);
        return $query->paginate($pagination);
    }
    public function querySearch()
    {
        if (empty($this->search)) 
            return [];
        $query=$this->model::query();
        $query=$this->searchFunction($query);
        return $query->take(5)->get();
    }

}
