<?php

namespace App\Livewire\administration\order;

use App\Livewire\AdminComponent;
use App\Models\Order;
use App\Traits\CrudTrait;
use App\Traits\FilterTrait;
use Livewire\WithPagination;

class OrderListAdmin extends AdminComponent
{
    use CrudTrait;
    use FilterTrait;
    use WithPagination;
    public $model=Order::class;
    public function render()
    {
        return view('livewire.administration.order.order-list-admin');
    }
    public function mount()
    {
        $this->searchWichColumn='user_id->';
        $this->searchAscDescWichColumn = 'totalPrice';
        $this->tabSearchPossibility=[
            'name'=>'nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'totalPrice'=>'prix total',
        ];
    }
}
