<?php

namespace App\Livewire\administration\payment;
use App\Livewire\AdminComponent;
use App\Models\Payment;

class PaymentListAdmin extends AdminComponent
{
    public $model=Payment::class;
    public function render()
    {
        return view('livewire.administration.payment.payment-list-admin',['listPayments'=>$this->query(10)]);
    }
    public function mount()
    {
        //peut-être rajouter la référence de commande
        $this->searchWichColumn='payment_method';
        $this->searchAscDescWichColumn = 'amount';
        $this->tabSearchPossibility=[
            'payment_method'=>'Méthode de paiement',
            'transaction_id'=>'ID de transaction',
        ];
        $this->tabSearchAscDescPossibility=[
            'amount'=>'Montant',
        ];
    }

}
