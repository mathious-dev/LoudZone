<?php

namespace App\Livewire\public\event;

use App\Livewire\PublicComponent;
use App\Models\Event;

class EventDetail extends PublicComponent
{
    public $event;
    public function render()
    {
        return view('livewire.public.event.event-detail');
    }
    public function mount(Event $event)
    {
        if($event)
            $this->event=$event;
    }
}
