<?php

namespace App\Livewire\administration\priceFilter;

use App\Livewire\AdminComponent;
use App\Models\PriceFilter;

class PriceFilterList extends AdminComponent
{
    protected $model=PriceFilter::class;
    public function render()
    {
        return view('livewire.administration.priceFilter.price-filter-list',['listPriceFilters'=>$this->query(5),
        'listSearch'=>$this->querySearch()]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'Nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'Nom',
            'max_price'=>'Prix max',
            'min_price'=>'Prix min',
        ];
    }
}
