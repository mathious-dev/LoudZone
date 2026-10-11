<?php

namespace App\Livewire\public\order;

use App\Livewire\PublicComponent;
use App\Models\Order;


class OrderForm extends PublicComponent
{
    public $order;
    public $total_price;
    public function render()
    {
        return view('livewire.public.order.order-form');
    }
    public function mount(Order $order=null)
    {
        if($order&&!empty($addInfo))
        {
            $this->order=$order;
            $this->fill($addInfo->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->order=new Order();
            $this->isEditing=false;
        }
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->order,'admin.orderAdminList');
    }
    public function rules()
    {
        return ['label'=>'required|max:255'];
    }
}
