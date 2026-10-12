<?php

namespace App\Livewire\administration\event;

use App\Livewire\AdminComponent;
use App\Models\Event;



class EventFormAdmin extends AdminComponent
{
    public $event;
    public $label;
    public $description;
    public $start_date;
    public $end_date;
    public $address_id;
    public function render()
    {
        return view('livewire.administration.event.event-form-admin');
    }
    public function mount(Event $event=null)
    {
        if($event&&$event->exists)
        {
            $this->event=$event;
            $this->fill($event->toArray());
            $this->isEditing=true;
        }
        else
        {
            $this->event=new Event();
            $this->isEditing=false;
        }
    }
    public function rules()
    {
        return['label'=>'required|max:255',
        'description'=>'nullable',
        'start_date'=>'required|date',
        'end_date'=>'required|date',
        'address_id'=>'required'];
    }
    public function saveForm()
    {
        $this->save($this->validate(),$this->model,'admin.eventListAdmin');
    }
}
