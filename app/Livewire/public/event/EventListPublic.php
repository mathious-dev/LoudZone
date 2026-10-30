<?php

namespace App\Livewire\public\event;

use App\Livewire\AdminComponent;
use App\Models\Event;

class EventListPublic extends AdminComponent
{
    public $model=Event::class;
    public function render()
    {
        return view('livewire.public.event.event-list-public',$this->query());
    }
    public function mount()
    {
        $this->searchWichColumn='label';
        $this->searchAscDescWichColumn = 'label';
        $this->tabSearchPossibility=[
            'label'=>'nom',
        ];
        $this->tabSearchAscDescPossibility=[
            'label'=>'nom',
            'start_date'=>'date de début',
            'end_date'=>'date de fin',
        ];
    }
}
