<?php

namespace App\Livewire\administration\category;

use App\Livewire\AdminComponent;
use App\Models\Category;

class CategoryList extends AdminComponent
{
    protected $model=Category::class;
    public function render()
    {
        return view('livewire.administration.category.category-list',['listCategories'=>$this->query(),
        'listSearch'=>$this->querySearch(),
        'listTypeCategories'=>Category::giveListTypeCategory()]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'Nom',
            'type'=>'Type'
        ];
        $this->tabSearchAscDescPossibility=[
            'title'=>'Nom',
            'type'=>'Type'
        ];
    }
}
