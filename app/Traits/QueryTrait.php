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
        return $query->paginate($pagination);
    }

}
