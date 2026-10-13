<?php

namespace App\Livewire\administration\order;

use App\Enum\StateEnum;
use App\Livewire\AdminComponent;
use App\Models\Order;


class OrderListAdmin extends AdminComponent
{
    public $refused=StateEnum::REFUSED;
    public $waiting=StateEnum::WAITING;
    public $finished=StateEnum::FINISHED;
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
            'reference'=>'Numéro de commande',
            'user_id'=>"Nom d'utilisateur",
        ];
        $this->tabSearchAscDescPossibility=[
            'total_price'=>'Prix total',
        ];
    }
}
