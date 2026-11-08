<?php

namespace App\Livewire\administration\priceFilter;

use App\Livewire\AdminComponent;
use App\Models\PriceFilter;
use Illuminate\Validation\Rule;

class PriceFilterForm extends AdminComponent
{
    public $label;
    public $max_price;
    public $min_price;
    public $is_active;
    public $priceFilter;
    public function render()
    {
        return view('livewire.administration.priceFilter.price-filter-form');
    }
    public function mount(PriceFilter $priceFilter)
    {
        if($priceFilter)
        {
            $this->priceFilter=$priceFilter;
            $this->fill($priceFilter->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->priceFilter=New PriceFilter();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->priceFilter,'admin.priceFilterList');
    }
    public function rules()
    {
        return ['label'=>['required','max:255',Rule::unique('price_filters')->ignore($this->priceFilter->id)],
        'max_price'=>'nullable',
        'min_price'=>'nullable',
        'is_active'=>'nullable',];
    }
}
