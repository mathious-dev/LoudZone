<?php

namespace App\Livewire\administration\order;

use App\Livewire\AdminComponent;
use App\Models\Order;


class OrderListAdmin extends AdminComponent
{

    public $model=Order::class;
    public function render()
    {
        return view('livewire.administration.order.order-list-admin',['listOrders'=>$this->query(10)]);
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
