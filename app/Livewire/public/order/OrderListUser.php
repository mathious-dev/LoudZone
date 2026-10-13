<?php

namespace App\Livewire\public\order;

use App\Livewire\PublicComponent;


class OrderListUser extends PublicComponent
{
    public $listOrders;
    public function render()
    {
        return view('livewire.public.order.order-list-user');
    }
    public function mount()
    {
        $this->listOrders=auth()->user()->orders;
    }
}
