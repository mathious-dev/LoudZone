<?php

namespace App\Livewire\administration\event;

use App\Livewire\AdminComponent;
use App\Models\Address;
use App\Models\Event;

class EventForm extends AdminComponent
{
    public $event;
    public $address;
    public $label;
    public $description;
    public $start_date;
    public $end_date;
    public $address_id;
    public $street;
    public $city;
    public $postal_code;
    public function render()
    {
        return view('livewire.administration.event.event-form');
    }
    public function mount(Event $event=null)
    {
        if($event&&$event->exists)
        {
            $this->event=$event;
            $this->fill($event->toArray());
            $this->address=$event->address;
            $this->fill($event->address->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->event=new Event();
            $this->address=new Address();
            $this->isEditing=false;
        }
    }
    public function rules()
    {
        return['label'=>'required|max:255',
        'description'=>'nullable',
        'start_date'=>'required|date',
        'end_date'=>'required|date',
        'street'=>'nullable|max:255',
        'city'=>'required|max:255',
        'postal_code'=>'required'];
    }
    public function saveForm()
    {
        $data=$this->validate();
        $dataAddress=[
            'street'=>$data['street'],
            'city'=>$data['city'],
            'postal_code'=>$data['postal_code'],
        ];
        $this->address->fill($dataAddress);
        $this->address->save();
        $dataEvent=[
            'label'=>$data['label'],
            'description'=>$data['description'],
            'start_date'=>$data['start_date'],
            'end_date'=>$data['end_date'],
            'address_id'=>$this->address->id,
        ];
        $this->save($dataEvent,$this->event,'admin.eventListAdmin');
    }
}
