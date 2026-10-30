<?php

namespace App\Livewire\administration\event;

use App\Livewire\AdminComponent;
use App\Models\Address;
use App\Models\Event;
use Livewire\WithFileUploads;

class EventForm extends AdminComponent
{
    use WithFileUploads;
    public $model=Event::class;
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
    public $primary_image;
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
        'primary_image'=>'nullable|max:1024',
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
        $textImage = $this->event->primary_image;
        if($this->primary_image) 
            $textImage = $this->primary_image->store('events', 'public');
        $dataEvent=[
            'label'=>$data['label'],
            'description'=>$data['description'],
            'start_date'=>$data['start_date'],
            'end_date'=>$data['end_date'],
            'primary_image'=>$textImage,
        ];
        $this->saveBelongsTo($this->event,$dataEvent,$this->address,$dataAddress,'address_id','admin.eventListAdmin');
    }
}
