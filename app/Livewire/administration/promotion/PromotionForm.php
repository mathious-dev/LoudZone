<?php

namespace App\Livewire\administration\promotion;

use App\Livewire\AdminComponent;
use App\Models\Promotion;


class PromotionForm extends AdminComponent
{
    public $model=Promotion::class;
    public $promotion;
    public $label;
    public $amount;
    public $start_date;
    public $end_date;
    public function render()
    {
        return view('livewire.administration.promotion.promotion-form');
    }
    public function mount(Promotion $promotion=null)
    {
        if($promotion&&!empty($promotion))
        {
            $this->promotion=$promotion;
            $this->fill($promotion->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->promotion=new Promotion();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->promotion,'admin.promotionList');
    }
    public function rules()
    {
        return ['label'=>'nullable|max:255',
        'amount'=>'required|max:100',
        'start_date'=>'required',
        'end_date'=>'nullable'];
    }
}
