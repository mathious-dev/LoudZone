<?php

namespace App\Livewire\administration\SupportMessageCategory;

use App\Livewire\AdminComponent;
use App\Models\SupportMessageCategory;

class SupportMessageCategoryList extends AdminComponent
{
    public $model=SupportMessageCategory::class;
    public function render()
    {
        return view('livewire.administration.supportMessageCategory.support-message-category-list',['listSupportMessageCategories'=>$this->query(10)]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'titre',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'titre'
        ];
    }
}
