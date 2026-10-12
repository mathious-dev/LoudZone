<?php

namespace App\Livewire\administration\payment;

use App\Livewire\AdminComponent;
use App\Models\Payment;


class PaymentListAdmin extends AdminComponent
{
    
    public $model=Payment::class;
    public function render()
    {
        return view('livewire.administration.payment.payment-list-admin',['listPayments'=>$this->query()]);
    }
    public function mount()
    {
        $this->searchWichColumn='reference';
        $this->searchAscDescWichColumn = 'total_price';
        $this->tabSearchPossibility=[
            'reference'=>'numéro de commande',
            'user_id'=>"nom d'utilisateur",
        ];
        $this->tabSearchAscDescPossibility=[
            'total_price'=>'prix total',
        ];
    }

}
