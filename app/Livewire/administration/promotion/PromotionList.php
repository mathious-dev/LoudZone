<?php

namespace App\Livewire\administration\promotion;

use App\Livewire\AdminComponent;
use App\Models\Promotion;

class PromotionList extends AdminComponent
{
    public bool $isDeleting=true;
    public $model=Promotion::class;
    public function render()
    {
        return view('livewire.administration.promotion.promotion-list',['listPromotions'=>$this->query(10)]);
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'amount';
        $this->tabSearchPossibility=[
            'label'=>'Nom',
            'amount'=>"Montant",
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'Nom',
            'amount'=>'Montant',
            'start_date'=>'Date de début',
            'end_date'=>'Date de fin',
        ];
    }
    public function deleteProm($promotionId)
    {
        $promotion=Promotion::find($promotionId);
        if($promotion)
        {
            $areArticlesLink=$promotion->articles()->exists();
            if(!$areArticlesLink)
            {
                $this->isDeleting=true;
                $this->delete($promotionId);
            }
            else
                $this->isDeleting=false;
        }
    }
}
