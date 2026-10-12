<?php

namespace App\Livewire\administration\addInfo;

use App\Livewire\AdminComponent;
use App\Models\AddInfo;


class AddInfoList extends AdminComponent
{

    public $model=AddInfo::class;
    public function render()
    {
        return view('livewire.administration.addInfo.add-info-list',['listAddInfos'=>$this->query(10)]);
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
}
