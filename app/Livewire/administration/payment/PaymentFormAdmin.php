<?php

namespace App\Livewire\administration\payment;

use App\Livewire\AdminComponent;
use App\Models\Payment;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class PaymentFormAdmin extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    public $model=Payment::class;
    public function render()
    {
        return view('livewire.administration.payment.payment-form-admin');
    }
}
