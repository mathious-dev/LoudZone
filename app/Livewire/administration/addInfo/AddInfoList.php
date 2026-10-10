<?php

namespace App\Livewire\administration\addInfo;

use App\Livewire\AdminComponent;
use App\Models\AddInfo;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class AddInfoList extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    public $model=AddInfo::class;
    public function render()
    {
        return view('livewire.administration.addInfo.add-info-list',['listAddInfos'=>$this->queryAddInfo()]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'nom',
        ];
    }
    public function queryAddInfo()
    {
        $query=AddInfo::query();
        $query=$this->searchFunction($query);
        $query=$this->searchAscDescFunction($query);
        return $query->paginate(10);
    }
}
